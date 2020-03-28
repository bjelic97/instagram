@include('comments.edit')

<div class="comment-{{$comment->id}}">
    <div class="d-flex align-items-center pt-2">
        <img src="{{asset($comment->user->profile->profileImage())}}" alt=""
             style="max-width:30px" class="rounded-circle mb-3">
        <a class="text-dark font-weight-bold pl-2 mb-3"
           href="{{url('/profile/'.$post->user->profile->id)}}">{{$comment->user->username}}</a>
    </div>

    <li class="list-group-item">
        <div id="comment-field-{{$comment->id}}">
            {!! $comment->body !!}
        </div>

        <p style="color:#d3d3d3">{{$comment->created_at->diffForHumans()}}
        </p>

        @if(($comment->user->id == session()->get('user')->id) || ($post->user->id == session()->get('user')->id))
            <div class="btn-group dropright">
                <button type="button"
                        class="btn btn-sm btn-outline-dark dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <i class="pt-1 fa fa-gears float-right pl-2"></i>
                </button>
                <div class="dropdown-menu">

                    @if($comment->user->id == session()->get('user')->id)
                        <input class="dropdown-item edit-comment fa fa-input"
                               data-id="{{$comment->id}}"
                               type="button" value="&#xf0ad Modify"/>
                    @endif
                    <button onclick="event.preventDefault();
                        document.getElementById('remove-comment-form-{{$comment->id}}').submit();"
                            class="dropdown-item" type="button"><i
                            class="fa fa-trash-o"></i> Remove
                    </button>
                </div>
            </div>

            <form id="remove-comment-form-{{$comment->id}}"
                  action="{{url('/p/'.$post->id.'/comments/'.$comment->id)}}"
                  method="POST"
                  style="display: none;">
                {{csrf_field()}}
                {{method_field('DELETE')}}
            </form>

        @endif


        <a onclick="event.preventDefault();
            document.getElementById('like-form-{{$comment->id}}').submit();"><i
                style="color:{{($comment->liked->contains(session()->get('user')->profile)) ? 'darkred' : '#d3d3d3'}}"
                class="fa fa-heart like-comment float-right"><strong
                    class="pl-1">{{($comment->liked->count() > 0) ? $comment->liked->count() : '' }}</strong></i></a>


    </li>

    <form id="like-form-{{$comment->id}}"
          action="{{url('/like/'.session()->get('user')->profile->id).'/'.$comment->id}}"
          method="POST"
          style="display: none;">
        @csrf
    </form>
</div>
