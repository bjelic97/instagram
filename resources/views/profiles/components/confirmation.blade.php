<!-- Modal -->
<div class="modal fade" id="{{$action_type_modal}}" tabindex="-1" role="dialog" aria-labelledby="{{$action_type_label}}"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$action_type_label}}">Confirm action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to {{$action_type}} this profile ?

            </div>
            <div class="modal-footer">
                @if($action_type == 'follow' || $action_type =='unfollow')
                    <button type="button"
                            class="btn btn-outline-{{($action_type == 'follow') ? 'primary' : 'danger'}} w-100"
                            onclick="event.preventDefault();
                                                     document.getElementById('follow-form-other').submit();">{{ucfirst($action_type)}}
                    </button>

                @else
                    <button type="button"
                            class="btn btn-danger w-100"
                            onclick="event.preventDefault();
                                document.getElementById('remove-user-form-{{$user_id}}').submit();">{{ucfirst($action_type)}}
                    </button>
                @endif
                <button type="button" class="btn btn-outline-secondary w-100" data-dismiss="modal">Cancel</button>
            </div>


            <form id="follow-form-other" action="{{url('/follow/'.$user_id)}}" method="POST"
                  style="display: none;">
                @csrf
            </form>

            <form id="remove-user-form-{{$user_id}}" action="{{url('/admin/user/'.$user_id)}}" method="POST"
                  style="display: none;">
                {{csrf_field()}}
                {{method_field('DELETE')}}
            </form>

        </div>
    </div>
</div>
