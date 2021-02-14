@extends('layout')
@section('content')
@if($photo->id)
	<h2 align="center">EDIT PHOTO</h2>
@else
	<h2 align="center">NEW PHOTO</h2>
@endif

@if($photo->id)
<form action="{{route('photos.update', $photo->id)}}" method="POST" enctype="multipart/form-data">
  
    {{method_field('PATCH')}}
@else
        <form action="{{route('photos.store')}}" method="POST" enctype="multipart/form-data">

@endif
	<div class="row">
	<input type="hidden" name="album_id" value="{{$photo->album_id?$photo->album_id : $album->id}}">
	{{csrf_field()}}
		<div class="form-group">
			<div class="col-sm-6 offset-sm-3">
    			<label for="name">NAME PHOTO</label>
    			<input type="text" class="form-control" name="name" value="{{$photo->name}}">
  			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-6 offset-sm-3">
				<label for="description">DESCRIPTION</label>
				<textarea name="description" rows="6" class="form-control" id="description">{{$photo->description}}</textarea>
				</div>
		</div>

		@include('images.partials.fileupload')

		<div class="form-group">
			<div class="form-group">
				<div class="col-sm-6 offset-sm-3">
  					<button type="submit" class="btn btn-primary btn-style">UPDATE</button>
  				</div>
  			</div>
  		</div>
	</div>
</form>
@stop