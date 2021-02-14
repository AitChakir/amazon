<div class="form-group">
		<div class="col-sm-6 offset-sm-3">
			<label for="album_thumb">AVATAR</label>
			<input type="file" class="form-control" name="album_thumb">
			</div>
	</div>
	@if($album->album_thumb)
	<div class="form-group">
		<div class="col-sm-6 offset-sm-3">
			<label for="avatar">AVATAR</label>
			<img src="{{$album->album_thumb}}" title="{{$album->album_thumb}}">
		</div>
	</div>
	@endif