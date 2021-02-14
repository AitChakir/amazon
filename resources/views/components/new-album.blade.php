@extends('layout')
@section('content')
<h2 align="center">NEW ALBUM</h2>
<form action="/albums/create" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}

	<div class="row">

		<div class="form-group">
			<div class="col-sm-6 offset-sm-3">
    			<label for="album_name">ALBUM NAME</label>
    			<input type="text" class="form-control" name="album_name">
  			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-6 offset-sm-3">
				<label for="description">DESCRIPTION</label>
				<textarea name="description" rows="6" class="form-control" id="description"></textarea>
				</div>
		</div>

		@include('partials.fileupload')

		<div class="form-group">
			<div class="form-group">
				<div class="col-sm-6 offset-sm-3">
  					<button type="submit" class="btn btn-primary">CREATE</button>
  				</div>
  			</div>
  		</div>
	</div>
</form>


@stop