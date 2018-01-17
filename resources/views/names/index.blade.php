
@extends('layout')

@section('title', 'Welcome')

@section('content')
<ul>
		@foreach ($names as $show)
			<li>
			<a href="index.php/names/{{$show->id}}"> {{$show->person_name}}</a> </li>
		@endforeach
	</ul>
@endsection