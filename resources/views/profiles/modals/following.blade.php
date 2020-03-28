{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="followingModal" tabindex="-1" role="dialog" aria-labelledby="followingModalLabel"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="followingModalLabel">Following</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                @foreach($user->following as $fwing)--}}
{{--                    <div class="row pb-2">--}}
{{--                        <div class="col-md-9 mt-1">--}}
{{--                            <a href="{{url('/profile/'.$fwing->id)}}" class="text-dark text-decoration-none">--}}
{{--                                <div>--}}
{{--                                    <img src="{{$fwing->profileImage()}}" alt="{{$fwing->title}}"--}}
{{--                                         style="width:25px">--}}
{{--                                    <strong class="pl-2">{{$fwing->title}}</strong>--}}

{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-2">--}}

{{--                                @if(session()->get('user')->profile->id != $fwing->id)--}}

{{--                                    @if(session()->get('user')->following->contains($fwing->id))--}}
{{--                                        <a class="btn btn-outline-light" data-toggle="modal"--}}
{{--                                           data-target="#confirmUnfollowModal">Following</a>--}}
{{--                                    @else--}}
{{--                                        <a style="color:white" class="btn btn-primary" data-toggle="modal"--}}
{{--                                           data-target="#confirmFollowModal">Follow</a>--}}
{{--                                    @endif--}}
{{--                                @endif--}}

{{--                        </div>--}}
{{--                    </div>--}}



{{--                    @include('profiles.modals.confirm-unfollow-following')--}}

{{--                    @include('profiles.modals.confirm-follow-following')--}}

{{--                @endforeach--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
