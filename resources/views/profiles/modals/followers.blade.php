{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="followersModal" tabindex="-1" role="dialog" aria-labelledby="followersModalLabel"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="followersModalLabel">Followers</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                @foreach($user->profile->followers as $fwers)--}}
{{--                    <div class="row pb-2">--}}
{{--                        <div class="col-md-9 mt-1">--}}
{{--                            <a href="{{url('/profile/'.$fwers->id)}}" class="text-dark text-decoration-none">--}}
{{--                                <div>--}}
{{--                                    <img src="{{$fwers->profile->profileImage()}}" alt="{{$fwers->profile->title}}"--}}
{{--                                         style="width:25px">--}}
{{--                                    <strong class="pl-2">{{$fwers->profile->title}}</strong>--}}

{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-2">--}}

{{--                            @if(session()->get('user')->profile->id != $fwers->profile->id)--}}

{{--                                @if(session()->get('user')->following->contains($fwers->profile->id))--}}
{{--                                    <a class="btn btn-outline-light" data-toggle="modal"--}}
{{--                                       data-target="#confirmUnfollowModal">Following</a>--}}
{{--                                @else--}}
{{--                                    <a style="color:white" class="btn btn-primary" data-toggle="modal"--}}
{{--                                       data-target="#confirmFollowModal">Follow</a>--}}
{{--                                @endif--}}
{{--                            @endif--}}


{{--                        </div>--}}
{{--                    </div>--}}



{{--                    @include('profiles.modals.confirm-unfollow-followers')--}}

{{--                    @include('profiles.modals.confirm-follow-followers')--}}

{{--                @endforeach--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
