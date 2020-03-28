@extends('layouts.front.master')

@section('content')

    <div class="container">

        <div class="row mb-5">

            <div class="col-md-7 offset-1">

                @foreach($posts as $post)

                    <div class="card mb-5">
                        <div class="card-title">
                            <div class="d-flex align-items-center pt-3">

                                <div class="pl-3 pr-3">
                                    <img src="{{asset($post->user->profile->profileImage())}}" alt=""
                                         style="max-width:50px" class="rounded-circle">

                                </div>
                                <div>
                                    <div class="font-weight-bold">
                                        <a class="text-dark text-decoration-none"
                                           href="{{url('/profile/'.$post->user->profile->id)}}">{{$post->user->username}}</a>

                                    </div>

                                </div>

                            </div>
                        </div>
                        <a href="{{url('/p/'.$post->id)}}"> <img class="card-img-top"
                                                                 src="{{asset('/storage/'.$post->image)}}"
                                                                 alt=""></a>
                        <div class="card-body">

                            <div>

                                @if($post->liked->contains(session()->get('user')->profile))
                                    <a href="#" class="text-dark" onclick="event.preventDefault();
                                        document.getElementById('like-post-form-{{$post->id}}').submit();"><i
                                            style="color:darkred" class="fa fa-heart fa-2x"></i></a>
                                @else <a href="#" class="text-dark" onclick="event.preventDefault();
                                    document.getElementById('like-post-form-{{$post->id}}').submit();"><i
                                        class="fa fa-heart-o fa-2x"></i></a>
                                @endif

                                <a class="text-dark" href="{{url('/p/'.$post->id)}}"><i
                                        class="ml-3 fa fa-comment-o fa-2x"></i></a>

                                <p class="mt-2"><strong>{{$post->liked->count()}} likes </strong></p>

                                <form id="like-post-form-{{$post->id}}"
                                      action="{{url('/like/'.session()->get('user')->profile->id).'/post/'.$post->id}}"
                                      method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>


                            </div>

                            <div class="d-flex">
                                <div>
                                    <a class="font-weight-bold text-dark text-decoration-none"
                                       href="{{url('/profile/'.$post->user->profile->id)}}">{{$post->user->username}}</a>
                                </div>
                                <div class="pl-2"> {{-- show only first 20/30 chars, za sada ovako --}}
                                    {!! $post->caption !!}
                                </div>

                            </div>


                            @foreach($post->comments as $comment)
                                @if ($loop->index < 1)

                                    <div class="d-flex">
                                        <div>
                                            <a class="font-weight-bold text-dark text-decoration-none"
                                               href="{{url('/profile/'.$post->user->profile->id)}}">{{$comment->user->profile->title}}</a>
                                        </div>
                                        <div class="pl-2">
                                            {!! $comment->body !!}
                                            {{-- show only first 20/30 chars--}}
                                        </div>
                                        <div style="margin-left: 500px" class="float-right">
                                            @if($comment->liked->contains(session()->get('user')->profile->id))
                                                <a href="#" class="text-dark" onclick="event.preventDefault();
                                                    document.getElementById('like-form-{{$comment->id}}').submit();"><i
                                                        style="color:darkred" class="fa fa-heart"></i></a>
                                            @else <a href="#" class="text-dark" onclick="event.preventDefault();
                                                document.getElementById('like-form-{{$comment->id}}').submit();"><i
                                                    class="fa fa-heart-o"></i></a>
                                            @endif
                                            <form id="like-form-{{$comment->id}}"
                                                  action="{{url('/like/'.session()->get('user')->profile->id).'/'.$comment->id}}"
                                                  method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>

                                @endif
                            @endforeach

                            @if($post->comments->count() > 1)
                                <a class="text-decoration-none" href="{{url('/p/'.$post->id)}}"
                                   style="color:#8e8e8e">View
                                    all {{$post->comments->count()}} comments </a>
                            @endif

                            <p class="mt-2" style="color:#8e8e8e">{{$post->created_at->diffForHumans()}}</p>
                            <hr class="b-shadow">

                            <div class="d-flex justify-content-between mt-4">
                                @include('comments.create')

                            </div>

                        </div>
                    </div>

                @endforeach
            </div>

            @include('suggestions.index')

        </div>


        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{$posts->links()}}
            </div>
        </div>

    </div>
@endsection
