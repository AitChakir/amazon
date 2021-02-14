@extends('layout')
@section('title', 'Albums')
@section('content')
<h2 style="margin-bottom: 10px" align="center">ALBUMS</h2>
@if(session()->has('message'))
	
	@component('components.alert-info')
		{{session()->get('message')}}
	@endcomponent
@endif

@if($albums)
	<ul class="list-group">
		@foreach($albums as $album)
			<li class="list-group-item d-flex justify-content-between">
				{{$album->id}} ) {{$album->album_name}}
				<div>
					@if($album->album_thumb)
						<img width="80" src="{{asset($album->path)}}" title="{{$album->album_thumb}}">
					@endif
					@if($album->photos_count)
					<a href="/album/{{$album->id}}/images" class="btn btn-success">IMAGES({{$album->photos_count}})</a>@endif
					<a href="/album/{{$album->id}}/edit" class="btn btn-warning">UPDATE</a>
					<a href="{{route('photos.create')}}?album_id={{$album->id}}" class="btn btn-info">NEW PHOTO</a>
					<a href="/album/{{$album->id}}/delete" class="btn btn-danger">DELETE</a>
				</div>
			</li>
		@endforeach
			<li style="list-style: none">
				{{$albums->links('vendor.pagination.bootstrap-4')}}
			</li>
	</ul>
@endif

@stop

@section('footer')
@parent
 <script>
 	$(document).ready(function(){
 		$('div.alert').fadeTo(5000, 0);
 	})
 </script>
@stop
