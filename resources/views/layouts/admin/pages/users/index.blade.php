@extends('layouts.admin.master')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card card-plain">
                <div class="card-header card-header-success">
                    <h4 class="card-title mt-0">Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="">
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Registration date
                            </th>
                            <th>
                                Profile
                            </th>
                            <th>
                                Remove
                            </th>
                            </thead>
                            <tbody>

                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        {{$user->created_at->toFormattedDateString()}}  {{$user->created_at->addHour()->toTimeString()}}
                                    </td>
                                    <td>
                                        <a class="text-decoration-none" href="{{url('/admin/profile/'.$user->profile->id)}}">
                                            <img class="rounded-circle mr-2"
                                                 style="max-width: 40px"
                                                 src="{{$user->profile->profileImage()}}"
                                                 alt="">
                                            {{$user->profile->title}}</a>
                                    </td>
                                    <td>
                                        <button type="button" rel="tooltip" title="Remove"
                                                class="btn btn-white btn-link btn-sm" data-toggle="modal"
                                                data-target="#confirmRemoveModal-{{$user->id}}">
                                            <i class="material-icons">delete</i>
                                        </button>

                                        @component('profiles.components.confirmation',['user_id' => $user->id ])
                                            @slot('action_type_modal')
                                                confirmRemoveModal-{{$user->id}}
                                            @endslot
                                            @slot('action_type')
                                                remove
                                            @endslot
                                            @slot('action_type_label')
                                                confirmRemoveModalLabel-{{$user->id}}
                                            @endslot


                                        @endcomponent

                                    </td>
                                </tr>

                            @endforeach

                            </tbody>

                        </table>
                    </div>
                    <div class="row">

                        <div class="col-12 d-flex justify-content-center">

                            {{$users->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
