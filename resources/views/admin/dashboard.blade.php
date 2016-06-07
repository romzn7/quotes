@extends('layout.master');

@section('content')
@if(Auth::check())
		<a href="{{ route('admin.logout') }}"><input type="button" value="Logout" class="btn btn-fail"></a>
@endif
	@foreach($authors as $author)
		<ul>
			<li> {{ $author->name }} ({{ $author->email }})</li>
		</ul>
	@endforeach
@stop