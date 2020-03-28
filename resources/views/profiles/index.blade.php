@extends('layouts.front.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img class="rounded-circle w-100"
                     src="{{asset($user->profile->profileImage())}}"/>
            </div>
            <div class="col-9">
                <div class="pt-5 d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h4">{{ $user->username}} </div>

                        {{--                        <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                                                    js started malfunctioning so - snalazim se
                        --}}

                        @if(session()->has('user'))
                            @if(session()->get('user')->id != $user->id)
                                <a class="btn btn-primary ml-4 text-white" onclick="event.preventDefault();
                                                     document.getElementById('follow-form').submit();">{{($follows) ? 'Unfollow' : 'Follow'}}</a>
                            @endif
                        @endif


                        <form id="follow-form" action="{{url('/follow/'.$user->id)}}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>

                    @if(session()->has('user'))
                        @if(session()->get('user')->id == $user->profile->user_id)
                            <a href="{{url('/p/create')}}">Add New Post</a>
                            {{--                            @can('update', $user->profile)-- iskljucena }}--}}

                            {{--                            @endcan--}}

                        @endif
                    @endif

                </div>

                @if(session()->has('user'))
                    @if(session()->get('user')->id == $user->profile->user_id)
                        <a href="{{url('/profile/'.$user->id.'/edit')}}">Edit Profile</a>
                        {{--                @can('update', $user->profile)--}}
                        {{--                 --}}
                        {{--                @endcan--}}
                    @endif

                @endif

                <div class="d-flex pt-2">
                    <div class="pr-5 btn"><strong>{{$postCount}}</strong> posts</div>
                    <div class="pr-5 btn" data-toggle="modal" data-target="#followersModal">
                        <strong>{{$followersCount}}</strong> followers
                    </div>
                    <div class="pr-5 btn" data-toggle="modal" data-target="#followingModal">
                        <strong>{{$followingCount}}</strong>
                        following
                    </div>
                </div>
                <div class="pt-4 font-weight-bold">{{ $user->profile->title}}</div>
                <div>{{ $user->profile->description}}
                </div>
                <div><a href="" class="font-weight-bold" style="color:#003569">{{ $user->profile->url}}</a></div>
            </div>
        </div>

        <hr class="b-shadow">

        <div class="row pt-5">

            @foreach($user->posts as $post)

                @include('profiles.partials.post')

            @endforeach
        </div>
    </div>

    @component('profiles.components.toggle-modal',['users' => $user->profile->followers])
        @slot('type')
            Followers
        @endslot
        @slot('modal')
            followersModal
        @endslot
        @slot('modal_label')
            followersModalLabel
        @endslot

    @endcomponent


    @component('profiles.components.toggle-modal',['users' => $user->following])
        @slot('type')
            Following
        @endslot
        @slot('modal')
            followingModal
        @endslot
        @slot('modal_label')
            followingModalLabel
        @endslot

    @endcomponent

    {{--        @include('profiles.modals.following')--}}

    {{--        @include('profiles.modals.followers')--}}




@endsection
