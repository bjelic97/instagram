<div class="col-4 b-shadow" style="background-color: #fff">
    <div>
        <div class="d-flex align-items-center pt-3">
            <div class="pr-3">
                <img src="{{asset($post->user->profile->profileImage())}}" alt=""
                     style="max-width:50px" class="rounded-circle">

            </div>

            <div>
                <div class="font-weight-bold">
                    <a class="text-dark"
                       href="{{url('/profile/'.$post->user->profile->id)}}">{{$post->user->username}}</a>

{{--                    @if(session()->get('user')->id != $post->user->id)--}}
{{--                        | <a href="#" onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('follow-form').submit();"--}}
{{--                             class="pl-3">{{(session()->get('user')->following->contains($post->user->id)) ? 'Unfollow' : 'Follow'}}</a>--}}
{{--                    @endif--}}
                    <a href="{{url('/profile/'.$post->user->profile->id)}}" class="btn btn-outline-dark ml-5"><i class="fa fa-arrow-left"></i> Back on profile</a>
{{--                    <a href="{{url('/profile/'.$post->user->profile->id)}}"><i class="fa fa-times ml-5 text-dark"></i></a>--}}

                    <form id="follow-form" action="{{url('/follow/'.$post->user->id)}}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>


                </div>


            </div>

        </div>


        <hr class="b-shadow">

        <p><span class="font-weight-bold"> <a class="text-dark"
                                              href="{{url('/profile/'.$post->user->profile->id)}}">{{$post->user->username}} </a></span>
        </p>

        {!! $post->caption !!}
        <p style="color:#d3d3d3">{{$post->created_at->diffForHumans()}}</p>
        <hr>
        <i class="fa fa-comments"></i> {{($post->comments->count() > 0) ? $post->comments->count() : ''}} |
        <i style="color:darkred"
           class="fa fa-heart"></i>{{($post->liked->count() > 0) ? $post->liked->count() : '' }}



        @if($post->user->id == session()->get('user')->id)

            <div class="dropdown float-right">
                <button type="button"
                        class="btn btn-sm btn-outline-dark"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu">

{{--                    <button onclick="event.preventDefault();--}}
{{--                                document.getElementById('remove-comment-form-').submit();"--}}
{{--                            class="dropdown-item" type="button"><i--}}
{{--                            class="fa fa-wrench"></i> Modify post--}}
{{--                    </button>--}}

                    <button onclick="event.preventDefault();
                        document.getElementById('remove-post-form-{{$post->id}}').submit();"
                            class="dropdown-item" type="button"><i
                            class="fa fa-trash-o"></i> Remove post
                    </button>

                    <form id="remove-post-form-{{$post->id}}"
                          action="{{url('/p/'.$post->id)}}"
                          method="POST"
                          style="display: none;">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                    </form>
                </div>
            </div>

        @endif
        <hr>

        <!-- COMMENTS SECTION -->
        <div class="comments">

            <ul class="list-group">

                @foreach($post->comments as $comment)
                    @include('comments.show')
                @endforeach

            </ul>

        </div>
        <!-- COMMENTS SECTION -->

        <!-- create comment section -->
    @include('comments.create')
    <!-- create comment section -->
    </div>

</div>
