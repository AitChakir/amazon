<?php

namespace App\Http\Controllers;

use App\Models\{Album, Photo};
use Illuminate\Http\Request;
//use LaraCourse\Models\Album;
use DB;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //DB::table('albums')
        $queryBilder = Album::orderBy('id', 'DESC')->limit(5)->withCount('photos');
        
        if ($request->has('id')) {
            $queryBilder->where('id','=',$request->input('id'));
        }

        if ($request->has('album_name')) {
            $queryBilder->where('album_name','like',$request->input('album_name').'%');  
        }
        

        $albums =  $queryBilder->paginate(env('PAGE_PER_PAGE'));
        //dd($albums);
        return  view('albums', ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $album = new Album();
        return view('components.new-album',['album'=>$album]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
/*
    protected function processFile($id, Request $request, &$album)
    {   

        if (!$request->hasFile('album_thumb')) {
            return false;
        }
        $file =  $request->file('album_thumb');
        if (!$file->isValid()) {
            return false;
        }
        $filename = $id.'.'.$file->extension();
        $file->storeAs(env('ALBUM_THUMB_DIR'), $filename);
        $album->album_thumb = env('ALBUM_THUMB_DIR'). $filename;
        return true;
        
    }*/

    public function store($id, Request $request)
    {
       
        $album = Album::find($id);
        $album->album_name = $request->input('album_name');
        $album->description = $request->input('description');
        $album->user_id = 1;
        
        //$this->processFile($id, $request, $album);
        if ($request->hasFile('album_thumb')) {
           $file =  $request->file('album_thumb');
           $filename = $id.'.'.$file->extension();
           $filename = $file->storeAs(env('IMG_DIR'), $filename);
           $album->album_thumb = $filename;
        }

        $res = $album->save();
        
        if ($res) {
          $message = "The album with id $id was successfully updated";
        }else{
             $message = "The album with id $id was not updated";
        }

        session()->flash('message', $message);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::find($id);
        return view('edit',['album' => $album]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($albumId)
    {
    
    }

    public function delete(Album $album)
    {
        //dd($album);
        $thumbNail = $album->album_thumb;
        //dd($thumbNail);
        
     
        $res = $album->delete();
          if($res && $thumbNail && \Storage::exists($thumbNail))   {
              \Storage::delete($thumbNail);
          }
       
       return redirect()->back();
    }


    public function save()
    {
        $album = new Album();
        $album->album_name = request()->input('album_name');
         $album->album_thumb = ''; 
        $album->description = request()->input('description');
        $album->user_id = 1;    
        
        $res = $album->save();
        if ($res) {
           //if(request()->hasFile('album_thumb')) {
               $file =  request()->file('album_thumb');
               $filename = $album->id.'.'.$file->extension();
               $filename = $file->storeAs(env('IMG_DIR'), $filename);
               $album->album_thumb = $filename;
               $album->save();
            //}
        }
        $name = request()->input('album_name');
        if ($res) {
          $message = "The album with id $name was successfully created";
        }else{
             $message = "The album with id $name was not created";
        }

        session()->flash('message', $message);
        return redirect('/');
    }

    public function getImages(Album $album)
    {
        //dd($album->id);
        $images = Photo::where('album_id', $album->id)->paginate(env('PAGE_PER_PAGE'));
        //return $images;
        return view('images.albumimages',compact('album','images'));
    }
}

 /* if ($request->hasFile('album_thumb')) {
           $file =  $request->file('album_thumb');
           $filename = $id.'.'.$file->extension();
           $filename = $file->storeAs(env('IMG_DIR'), $filename);
           $album->album_thumb = $filename;
        }*/