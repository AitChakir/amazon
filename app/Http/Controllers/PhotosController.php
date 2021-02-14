<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Album;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Photo::orderBy('id', 'DESC')->limit(5)
        //return Photo::limit(5);
    }

    protected function processFile(Photo $photo, Request $request = null)
    {   
        if (!$request) {
            $request = request();
        }
        
        if (!$request->hasFile('img_path')) {
            return false;
        }
        $file =  $request->file('img_path');
        if (!$file->isValid()) {
            return false;
        }
        $filename = $photo->id.'.'.$file->extension();
        $file->storeAs(env('IMG_DIR').'/'. $photo->album_id, $filename);
        $photo->img_path = env('IMG_DIR').'/'.$photo->album_id.'/'. $filename;
        return true;
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req )

    {
        $id = $req->has('album_id')?$req->input('album_id') : null;
        //dd($id);
        $album = Album::firstOrNew(['id' =>$id]);
        //dd($album);
        $photo = new Photo();
        return view('images.editAlbums', compact('album','photo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
       //dd($photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        return view('images.editAlbums', compact('photo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        
        $this->processFile($photo);
        //dd($request->hasFile('img_path'));
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $res = $photo->save();
           
        if ($res) {
          $message = "The album with id $photo->name was successfully updated";
        }else{
             $message = "The album with id $photo->name was not updated";
        }

        session()->flash('message', $message);
        return redirect()->route('album.getImages', $photo->album_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Photo::findorFail($id)->destroy();
    }

    public function delete(Photo $photo)
    {
        //dd($album);
        $thumbNail = $photo->name;
        //dd($thumbNail);
        
     
        $res = $photo->delete();
          if($res && $thumbNail && \Storage::exists($thumbNail))   {
              \Storage::delete($thumbNail);
          }
       
       return redirect()->back();
    }
}
