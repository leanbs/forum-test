@extends('layouts.masters.main')

@section('page-content')

  <div class="container">

  @include('layouts.masters.nav')

      <div class="well">
        <div class="media">
          <div class="media-body">
            <h4 class="media-heading">{{ $post->title }}</h4>
            <p class="text-right">By : {{ $post->user->name }}</p>
            <p><?php echo $post->body; ?></p>
            <ul class="list-inline list-unstyled">
              <li><span><i class="glyphicon glyphicon-calendar"></i> {{ $post->created_at->diffForHumans()}}</span></li>
            </ul>
          </div>
        </div>
        @if(Auth::User() && Auth::User()->id == $post->user_id)

            {!! Form::open(['url' => 'question/posts', 'id' => 'delete-question-form','method' =>'DELETE', 'class' => 'text-right']) !!}

              {!! Form::hidden('post_id', $post->id) !!}

              {!! Form::button('Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

            {!! Form::close() !!}

          @endif
      </div>

    @forelse($post->replies as $reply)

      <div class="well">
        <div class="media">
          <div class="media-body">
          <p class="text-right">By : {{ $post->user->name }}</p>
            <p>{{ $reply->body }}</p>
            <ul class="list-inline list-unstyled">
              <li><span><i class="glyphicon glyphicon-calendar"></i> {{ $post->created_at->diffForHumans()}}</span></li>
            </ul>
          </div>
        </div>
        @if(Auth::User() && Auth::User()->id == $reply->user_id)

            {!! Form::open(['url' => 'question/reply', 'id' => 'delete-reply-form','method' =>'DELETE', 'class' => 'text-right']) !!}

              {!! Form::hidden('reply_id', $reply->id) !!}

              {!! Form::button('Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

            {!! Form::close() !!}

          @endif
      </div>

    @empty
      <p>Be the first to reply</p>
    @endforelse

    @if(Auth::user())

      {!! Form::open(['url' => 'question/reply', 'id' => 'reply-question-form']) !!}

        {!! Form::hidden('slug', $post->slug) !!}
        {!! Form::textarea('body', null, [
          'id' => 'body', 
          'class' => 'form-control', 
          'placeholder' => 'Type your reply here !'
        ]) !!}
        <br/>
        {!! Form::button('Reply', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit']) !!}

      {!! Form::close() !!}

    @endif

  </div> <!-- /container -->

@stop