<div class="col-8">
    <div class="card" >
        <img src="{{asset('/storage/'.$post->image)}}" alt="" class="w-100 b-shadow card-img-top">

            <button onclick="event.preventDefault();
                document.getElementById('like-post-form-{{$post->id}}').submit();" id="like-post-toggle"
                    class="b-shadow btn btn-lg card-body {{($post->liked->contains(session()->get('user')->profile)) ? 'btn-danger' : 'btn-outline-danger'}}">
                <i
                    style="color:darkred}}"
                    class="fa fa-heart"></i></button>

            <form id="like-post-form-{{$post->id}}"
                  action="{{url('/like/'.session()->get('user')->profile->id).'/post/'.$post->id}}"
                  method="POST"
                  style="display: none;">
                @csrf
            </form>

    </div>

</div>


