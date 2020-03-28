<div class="mt-3">
    <div class="d-flex align-items-center">
        <img src="{{asset(session()->get('user')->profile->profileImage())}}" alt=""
             style="max-width:30px" class="rounded-circle mb-3">
        <a class="text-dark font-weight-bold pl-2 mb-3"
           href="{{url('/profile/'.$post->user->profile->id)}}">{{session()->get('user')->username}}</a>
    </div>


    <form method="POST" action="{{url('/p/'.$post->id.'/comments')}}">
        {{csrf_field()}}
        <textarea
            class="form-control @error('body') is-invalid @enderror summernote"
            name="body"></textarea>
        @error('body')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        <button class="mt-2 mb-1 btn btn-outline-dark float-right">Add comment</button>
    </form>

</div>
