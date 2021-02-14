@extends('layout')
@section('content')
<h2 align="center"> PHOTOS OF {{strtoupper($album->album_name)}}</h2>
@if(session()->has('message'))
	
	@component('components.alert-info')
		{{session()->get('message')}}
	@endcomponent
@endif
<table class="table table-striped">
	<thead>
		<tr>
			<th>IMAGE</th>
			<th>IMAGE NAME</th>
			<th>ALBUM NAME</th>
			<th>DATE CREATED</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	@forelse($images as $image)
		<tr>
			<td>
				<img width="60" src="{{asset($image->path)}}">
			</td>
			<td>{{$image->name}}</td>
			<td>{{$album->album_name}}</td>
			<td>{{$image->created_at}}</td>
			<td>
				<a href="{{route('photos.edit',$image->id)}}" class="btn btn-info">UPDATE</a>
				<a href="/photo/{{$image->id}}/delete" class="btn btn-danger">DELETE</a>
			</td>
		</tr>
	@empty
			<tr>
				<td>THE IS NO FOTO</td>
			</tr>
	@endforelse
</tbody>
<tfoot>
	<tr>
		<td colspan="5">
			{{$images->links('vendor.pagination.bootstrap-4')}}
		</td>
	</tr>
</tfoot>
</table>
@endsection
@section('footer')
@parent
 <script>
 	$(document).ready(function(){
 		$('div.alert').fadeTo(5000, 0);
 	})
 </script>
@stop