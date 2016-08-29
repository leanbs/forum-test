@extends('layouts.masters.main')

@section('page-content')
	
	<div class="container">

		@include ('layouts.masters.nav')

		@include ('layouts.partials.errors')

		{!! Form::open(['id' => 'post-question-form']) !!}

			{!! Form::label('title', 'Title') !!}
			{!! Form::text('title', null, [
				'id' => 'title', 
				'class' => 'form-control', 
				'placeholder' => 'Title'
			]) !!}
			<br/>
			{!! Form::label('category', 'Category') !!}
				<select name="category" class="form-control">
					@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name}}</option>
					@endforeach
				</select>
			<br/>
			{!! Form::label('body', 'Body') !!}
			{!! Form::textarea('body', null, [
				'id' => 'body', 
				'class'=> 'form-control', 
				'placeholder' => 'Tell us about your question'
			]) !!}
			
			<br/>
			{!! Form::button('Post', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit']) !!}

		{!! Form::close() !!}

	</div> <!-- /container -->
@stop