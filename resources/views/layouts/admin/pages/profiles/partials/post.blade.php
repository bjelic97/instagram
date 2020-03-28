<div class="col-3 pb-4 cont">
    <a href="#" data-toggle="modal"
       data-target="#post-modal-{{$post->id}}">
        <img class="w-100 image"
             src="/storage/{{$post->image}}"
             alt="">
        <div class="middle">
            <div class="text d-flex">
                <i style="color:darkred" class="fa fa-heart fa-5x"></i>
                <div style="color:darkred"><strong>{{$post->liked->count()}}</strong></div>
                <i style="color:black" class="fa fa-comments fa-5x"></i>
                <div style="color:black"><strong>{{$post->comments->count()}}</strong></div>
            </div>
        </div>
    </a>

    @include('layouts.admin.pages.profiles.modals.post-modal')


</div>
