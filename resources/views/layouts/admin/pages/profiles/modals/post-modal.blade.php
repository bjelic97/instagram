<!-- Modal -->
<div class="modal fade" id="post-modal-{{$post->id}}" tabindex="-1" role="dialog"
     aria-labelledby="post-modal-{{$post->id}}Label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <div class="modal-body">

                <div class="row">
                    <div class="col-md-8">
                        <img class="w-100" src="{{url('/storage/'.$post->image)}}" alt="">
                    </div>

                    <div class="col-md-4">
                        <div class="mt-3">
                            <img class="rounded-circle" style="max-width: 40px"
                                 src="{{url($post->user->profile->profileImage())}}" alt="">
                            <a class="text-decoration-none font-weight-bold text-dark pl-2"
                               href="{{url('/admin/profile/'.$post->user->profile->id)}}">{{$post->user->profile->title}}</a>
                        </div>

                        <div class="d-flex mt-3">
                            <div>
                                <a class="text-decoration-none font-weight-bold text-dark pt-2"
                                   href="{{url('/admin/profile/'.$post->user->profile->id)}}">{{$post->user->profile->title}}
                                    : </a>
                            </div>
                            <div class="pl-1">
                                {!! $post->caption !!}
                            </div>

                        </div>
                        <p style="color:#8c8c8c">{{$post->created_at->diffForHumans()}}</p>

                        <hr>
                        <i class="material-icons">favorite_border</i> {{$post->liked->count()}}
                        | <i class="material-icons">comment</i> {{$post->comments->count()}}
                        <button style="margin-left: 60px" type="button"
                                class="btn btn-danger" data-toggle="modal"
                                data-target="#confirmRemovePostModal-{{$post->id}}">
                            <i class="material-icons">delete</i>
                        </button>


                        @component('layouts.admin.components.confirm-remove',['entity_id' => $post->id ])
                            @slot('action_type_modal')
                                confirmRemovePostModal-{{$post->id}}
                            @endslot
                            @slot('entity_type')
                                post
                            @endslot
                            @slot('action_type')
                                remove
                            @endslot
                            @slot('action_type_label')
                                confirmRemovePostModalLabel-{{$post->id}}
                            @endslot


                        @endcomponent

                        <hr>


                        @foreach($post->comments as $comment)

                            <div class="d-flex align-items-baseline">
                                <div>
                                    <a class="text-decoration-none font-weight-bold text-dark pt-2"
                                       href="{{url('/admin/profile/'.$comment->user->profile->id)}}">
                                        <img style="max-width:30px" class="rounded-circle"
                                             src="{{$comment->user->profile->profileImage()}}"
                                             alt="">
                                        {{$comment->user->profile->title}}
                                        : </a>
                                </div>
                                <div class="pl-1">
                                    {!! $comment->body !!}
                                </div>

                            </div>

                            <div class="d-flex justify-content-between">
                                <div>
                                    <p style="color:#8c8c8c">{{$comment->created_at->diffForHumans()}}</p>
                                </div>
                                <div>
                                    <button style="padding-bottom: 20px;" type="button" rel="tooltip" title="Remove"
                                            class="btn btn-link btn-sm" data-toggle="modal"
                                            data-target="#confirmRemoveCommentModal-{{$comment->id}}">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <i class="material-icons">favorite</i> {{$comment->liked->count()}}

                                </div>
                            </div>

                            @component('layouts.admin.components.confirm-remove',['entity_id' => $comment->id ])
                                @slot('action_type_modal')
                                    confirmRemoveCommentModal-{{$comment->id}}
                                @endslot
                                @slot('entity_type')
                                    comment
                                @endslot
                                @slot('action_type')
                                    remove
                                @endslot
                                @slot('action_type_label')
                                    confirmRemoveCommentModalLabel-{{$comment->id}}
                                @endslot


                            @endcomponent


                        @endforeach


                    </div>
                </div>


            </div>


            <form id="follow-form-other" action="{{url('/follow/'.$post->user->id)}}" method="POST"
                  style="display: none;">
                @csrf
            </form>

            <form id="remove-user-form-{{$post->user->id}}" action="{{url('/admin/user/'.$post->user->id)}}"
                  method="POST"
                  style="display: none;">
                {{csrf_field()}}
                {{method_field('DELETE')}}
            </form>

        </div>
    </div>
</div>
