@if($flash = session('message'))
    <div id="flash-message" class="alert alert-success b-shadow" role="alert">
        {{$flash}}
    </div>
@endif
