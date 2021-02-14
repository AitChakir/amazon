<div class="form-group">
		<div class="col-sm-6 offset-sm-3">
			<label for="img_path">AVATAR</label>
			<input type="file" class="form-control" name="img_path">
			</div>
	</div>&nbsp;
	@if($photo->img_path)
	<div class="form-group">
		<div class="col-sm-6 offset-sm-3">
			<img width="100" src="{{$photo->img_path}}" title="{{$photo->img_path}}">
		</div>
	</div>&nbsp;
	@endif