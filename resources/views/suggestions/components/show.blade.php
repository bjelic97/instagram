<div class="row mt-2 pb-3">
    <div class="col-md-9">
        <a href="{{url('/profile/'.$profile->id)}}"
           class="text-dark text-decoration-none">
            <div>
                <img class="rounded-circle" src="{{$profile->profileImage()}}"
                     alt="{{$profile->title}}"
                     style="width:25px">
                <strong class="pl-2">{{$profile->title}}</strong>

            </div>
        </a>
    </div>
    <div class="col-md-2">
        <a href="#" class="text-decoration-none" onclick="event.preventDefault();
            document.getElementById('follow-form-{{$profile->id}}').submit();">Follow</a>
        <form id="follow-form-{{$profile->id}}" action="{{url('/follow/'.$profile->id)}}" method="POST"
              style="display: none;">
            @csrf
        </form> {{--  baci u include--}}

    </div>
</div>
