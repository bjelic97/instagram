@extends('layouts.admin.master')

@section('content')

    <div class="row">

        <div class="col-md-5">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="{{url('/admin/profile/'.$profile->id)}}">
                        <img class="img"
                             src="{{url($profile->profileImage())}}"/>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category">{{$profile->title}}</h6>
                    <h4 class="card-title"> {!! $profile->description !!}</h4>
                    <p class="card-description">

                        <a href="{{url(($profile->url) ? $profile->url : '')}}">{{($profile->url) ? $profile->url : 'URL not updated'}}</a>
                    </p>
                    <button type="button"
                            class="btn btn-danger" data-toggle="modal"
                            data-target="#confirmRemoveModal-{{$profile->user->id}}">
                        Remove profile <i class="material-icons">delete</i>
                    </button>

                    @component('profiles.components.confirmation',['user_id' => $profile->user->id ])
                        @slot('action_type_modal')
                            confirmRemoveModal-{{$profile->user->id}}
                        @endslot
                        @slot('action_type')
                            remove
                        @endslot
                        @slot('action_type_label')
                            confirmRemoveModalLabel-{{$profile->user->id}}
                        @endslot


                    @endcomponent
                </div>
            </div>
        </div>

        <div class="col-md-6 ml-5">

            <div class="row">

                @component('layouts.admin.components.stat',[
                         'size' => 6,
                       'type' => 'success',
                       'icon' => 'description',
                        'title' => 'Total Posts',
                        'count' =>  $postCount
                   ])

                @endcomponent

                @component('layouts.admin.components.stat',[
                         'size' => 6,
                       'type' => 'warning',
                       'icon' => 'supervised_user_circle',
                        'title' => 'Followers',
                        'count' =>  $followersCount
                   ])

                @endcomponent
            </div>

            <div class="row d-flex justify-content-center">

                @component('layouts.admin.components.stat',[
                         'size' => 6,
                       'type' => 'warning',
                       'icon' => 'supervisor_account',
                        'title' => 'Following',
                        'count' =>  $followingCount
                   ])

                @endcomponent


            </div>
        </div>


    </div>

    <div class="row mt-5">

        @foreach($profile->user->posts as $post)

            @include('layouts.admin.pages.profiles.partials.post')

        @endforeach

    </div>

@endsection
