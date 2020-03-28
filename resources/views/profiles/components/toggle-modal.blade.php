<!-- Modal -->
<div class="modal fade" id="{{$modal}}" tabindex="-1" role="dialog" aria-labelledby="{{$modal_label}}"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$modal_label}}">{{$type}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($users as $user)
                    <div class="row pb-2">
                        <div class="col-md-9 mt-1">
                            <a href="{{url('/profile/'.$user->id)}}" class="text-dark text-decoration-none">
                                <div>
                                    <img
                                        src="{{($type == 'Followers') ?  $user->profile->profileImage() : $user->profileImage()}}"
                                        alt="{{($type == 'Followers') ?  $user->profile->title : $user->title }}"
                                        style="width:25px">
                                    <strong
                                        class="pl-2">{{($type == 'Followers') ? $user->profile->title : $user->title }}</strong>

                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">

                            @if(session()->get('user')->profile->id != $user->id)

                                @if(session()->get('user')->following->contains($user->id))
                                    <a class="btn btn-outline-light" data-toggle="modal"
                                       data-target="#confirmUnfollowModal-{{$user->id}}">Following</a>
                                @else
                                    <a style="color:white" class="btn btn-primary" data-toggle="modal"
                                       data-target="#confirmFollowModal-{{$user->id}}">Follow</a>
                                @endif
                            @endif

                        </div>
                    </div>


                    @component('profiles.components.confirmation',['user_id' => ($type == 'Followers') ? $user->profile->id : $user->id ])
                        @slot('action_type_modal')
                            confirmFollowModal-{{$user->id}}
                        @endslot
                        @slot('action_type')
                            follow
                        @endslot
                        @slot('action_type_label')
                            confirmFollowModalLabel-{{$user->id}}
                        @endslot


                    @endcomponent


                    @component('profiles.components.confirmation',['user_id' => ($type == 'Followers') ? $user->profile->id : $user->id ])
                        @slot('action_type_modal')
                            confirmUnfollowModal-{{$user->id}}
                        @endslot
                        @slot('action_type')
                            unfollow
                        @endslot
                        @slot('action_type_label')
                            confirmUnfollowModalLabel-{{$user->id}}
                        @endslot

                    @endcomponent


                    {{--                                        @include('profiles.modals.confirm-unfollow')--}}

                    {{--                                        @include('profiles.modals.confirm-follow')--}}

                @endforeach

            </div>

        </div>
    </div>
</div>
