<div class="mt-3 dissapear edit-comment-form-{{$comment->id}}">
    <div class="d-flex align-items-center">
        <img src="{{asset(session()->get('user')->profile->profileImage())}}" alt=""
             style="max-width:30px" class="rounded-circle mb-3">
        <a class="text-dark font-weight-bold pl-2 mb-3"
           href="{{url('/profile/'.$post->user->profile->id)}}">{{session()->get('user')->username}}</a>

    </div>

    <button id="{{$comment->id}}"
            class="btn btn-outline-danger close-edit-comment"><i
            class="fa fa-times float-right"></i></button>


    <form action="{{url('/p/'.$post->id.'/comments/'.$comment->id)}}" method="POST"
          enctype="multipart/form-data">

        {{csrf_field()}}
        @method('PATCH')

        <textarea id="edit-field-{{$comment->id}}"
                  class="@error('body') is-invalid @enderror form-control summernote"
                  name="body"></textarea>
        @error('body')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        <button class="mt-2 mb-1 btn btn-outline-primary float-right"><i
                class="fa fa-floppy-o"></i></button>
    </form>

</div>
