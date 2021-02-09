@extends('layout')

@section('title', $title)

@section('content')

<div>
<h1>{{$title}}</h1>

@if ($about) 
	<ul>
	@foreach ($about as $key)
		<li>{{$key['name']}} {{$key['lastname'] }}</li>
	@endforeach
	</ul>
@endif
</div>
@stop