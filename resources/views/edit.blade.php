@extends('layout')
@section('content')
<h2 align="center">EDIT ALBUM</h2>
<form enctype="multipart/form-data" action="/albums/{{$album->id}}" method="POST">
	{{csrf_field()}}
	<input type="hidden" name="_method" value="PATCH">
	<div class="row">

		<div class="form-group">
			<div class="col-sm-6 offset-sm-3">
    			<label for="album_name">ALBUM NAME</label>
    			<input type="text" class="form-control" name="album_name" value="{{$album->album_name}}">
  			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-6 offset-sm-3">
				<label for="description">DESCRIPTION</label>
				<textarea name="description" rows="6" class="form-control" id="description">{{$album->description}}</textarea>
				</div>
		</div>

		@include('partials.fileupload')

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
