<div class="col-md-2 offset-5" style="position: fixed;border:1px solid #d3d3d3;background-color: #fff">
    <div class="d-flex">
        <h6 class="font-weight-bold pt-3 pl-1" style="color:#8e8e8e">Suggestions For You</h6>

    </div>

    @if(session()->get('user')->profile->followers->count() > 0)

        @foreach(session()->get('user')->profile->followers as $follower)

            @if(session()->get('user')->following->contains($follower->id) || $suggestions->contains($follower->id) || $follower->role_id == 1)

            @else

                @if($loop->index < 3)
                    @component('suggestions.components.show',['profile' => $follower->profile])

                    @endcomponent

                @endif


                @foreach($follower->following as $fwing)

                    @if(session()->get('user')->following->contains($fwing->id) || session()->get('user')->id == $fwing->id || $suggestions->contains($fwing->id))

                    @else
                        @if($loop->index < 3)

                            @component('suggestions.components.show',['profile' => $fwing])

                            @endcomponent
                        @endif
                    @endif

                @endforeach

            @endif
        @endforeach


    @endif

    @foreach($suggestions as $suggested)

        @component('suggestions.components.show',['profile' => $suggested->profile])

        @endcomponent

    @endforeach


</div>
