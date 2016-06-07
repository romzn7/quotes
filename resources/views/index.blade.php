@extends('layout.master')

@section('title')
	Trending Quotes
@stop

@section('content')
		@if(Session::has('message'))
			<div class="alert alert-success">
					{{ Session::get('message') }}
			</div>
		@endif
		
		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		       
		            @foreach ($errors->all() as $error)
	                	{{ $error }}
		            @endforeach
		        
		    </div>
		@endif

		@if(!empty(Request::segment(1)))
			<div class="alert alert-warning" role="alert">
				Filter has been set <a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
			</div>
			
		@endif
		<a href="{{ route('admin.login') }}"><input type="button" value="Admin" class="btn btn-success"></a>
		
	<H1> Trending Quotes</H1>
		<div class="row">

			@for($i=0; $i<count($quotes); $i++)
			<div class="col-xs-6 col-md-4">
			  	<blockquote>
			  		<p class="text-right"> <a href="{{ route('delete', ['id' => $quotes[$i]->id]) }}" > <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a> </p>
					  <p>{{ $quotes[$i]->quote }}</p>
					  <footer>Quote by<a href='{{ route('home', ['author' => $quotes[$i]->author->name]) }}'>{{ $quotes[$i]->author->name }}</a> at {{ $quotes[$i]->created_at }}</footer>
				</blockquote>		  	
		  	</div> 
			@endfor

		</div>
			
		<p class="text-center">
			
			@if($quotes->currentPage() !== 1)
				<a href="{{ $quotes->previousPageURL() }}"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span></a>
			@endif

			@if($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
				<a href="{{ $quotes->nextPageURL() }}"><span class="glyphicon glyphicon-forward" aria-hidden="true"></span></a>
			@endif

		

		</p>
		

		<br> <br>

		
		<h1>Add Your Quotes Here</h1>

		{!! Form::open(array('route' => 'create')) !!}
    		<div class='form-group'>
    			{!! Form::label('name', 'Author Name') !!}
    			{!! Form::text('name', null, array('class' => 'form-control')) !!}
    		</div>
    		
    		<div class='form-group'>
    			{!! Form::label('email', 'E-Mail') !!}
    			{!! Form::email('email', null, array('class' => 'form-control')) !!}
    		</div>

    		<div class='form-group'>
    			{!! Form::label('quote', 'I qoute') !!}
    			{!! Form::textarea('quote', null, array('class' => 'form-control')) !!}
    		</div>

    		<div class='form-group'>
    			{!! Form::submit('Quoted', array('class' => 'btn btn-success')) !!}
    		</div>

		{!! Form::close() !!}
	@stop