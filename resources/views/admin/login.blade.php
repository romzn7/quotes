@extends('layout.master')

@section('content')
@if (count($errors) > 0)
		    <div class="alert alert-danger">
		               
		            @foreach ($errors->all() as $error)
	                	{{ $error }}
		            @endforeach
		        
		    </div>
@endif

@if ( Session::has('fail'))
		    <div class="alert alert-danger">
		               
		            {{ Session::get('fail') }}
		        
		    </div>
@endif

	<h1>Log In</h1>
		{{ Form::open(['route' => 'admin.userlogin']) }}
			<div class='form-group'>
	    			{!! Form::label('username', 'Username') !!}
	    			{!! Form::text('username', null, array('class' => 'form-control')) !!}
	    	</div>

	    	<div class='form-group'>
	    		{!! Form::label('password', 'Password') !!}
	    		{!! Form::password('password', array('class' => 'form-control')) !!}
	    	</div>

	    	<div class='form-group'>
	    		
	    		{!! Form::submit('Log In', array('class' => 'btn btn-success')) !!}
	    	</div>

		{{ Form::close() }}
@stop