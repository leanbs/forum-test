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

@section('script')
	<script type="text/javascript">
		tinymce.init({
		    selector: '#body',
		    theme: 'modern',
		    plugins: [
		      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		      'save table contextmenu directionality emoticons template paste textcolor'
		    ],
		    content_css: 'css/content.css',
		    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | fontsizeselect | fontselect',
		 	fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
			font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n'
	  	});
	</script>
@stop
