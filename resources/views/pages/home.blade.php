@extends('layouts.masters.main')

@section('page-content')

  <div class="container">

  @include('layouts.masters.nav')

    @forelse($posts as $post)
      <div class="well">
        <div class="media">
          <div class="media-body">
            <h4 class="media-heading"><a href="http://localhost/forumtesting/public/question/{{$post->slug}}">{{ $post->title }}</a></h4>
            <p class="text-right">By : {{ $post->user->name }}</p>
            <p><?php echo $post->body; ?></p>
            <ul class="list-inline list-unstyled">
              <li><span><i class="glyphicon glyphicon-calendar"></i> {{ $post->created_at->diffForHumans()}}</span></li>
              <li>|</li>

              @if( $post->replies->count() > 0)
                <li> {{ $post->replies->count() }} Comments</li>
              @else
                <li>Be the first to reply</li>
              @endif
            </ul>
          </div>

          @if(Auth::User() && Auth::User()->id == $post->user_id)

            {!! Form::open(['url' => 'question/posts', 'id' => 'delete-question-form','method' =>'DELETE', 'class' => 'text-right']) !!}

              {!! Form::hidden('post_id', $post->id) !!}

              {!! Form::button('Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

            {!! Form::close() !!}

          @endif

        </div>
      </div>
    @empty
      <p>No posts found</p>
    @endforelse

    {!! $posts->appends(Request::all())->render() !!}
  </div> <!-- /container -->

@stop
