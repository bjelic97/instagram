@extends('layouts.admin.master')

@section('content')
    <div class="row">

        @component('layouts.admin.components.stat',[
                        'size' => 2,
                        'type' => 'success',
                        'icon' => 'description',
                         'title' => 'Total Posts',
                         'count' => ($totalPosts > 0) ? $totalPosts : 0
                    ])

        @endcomponent

        @component('layouts.admin.components.stat',[
                        'size' => 2,
                        'type' => 'warning',
                        'icon' => 'supervised_user_circle',
                         'title' => 'Total Users',
                         'count' => ($totalUsers > 0) ? $totalUsers : 0
                    ])

        @endcomponent


        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 offset-1">
            <div class="card">
                <div class="card-header card-header-tabs card-header-success">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper text-center">

                            <span>Activities</span>

                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Activity</th>
                                    <th>Time</th>
                                    <th>Remove</th>
                                </tr>
                                @foreach($activities as $activity)

                                    <tr>
                                        <td style="word-break: break-all">{!! $activity->body !!}</td>
                                        <td>
                                            {{$activity->created_at->toFormattedDateString()}} {{$activity->created_at->addHour()->toTimeString()}}
                                        </td>
                                        <td class="pl-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input id="delete-activity-chb" class="form-check-input"
                                                           type="checkbox" value=""
                                                           onclick=" document.getElementById('remove-activity-form-{{$activity->id}}').submit();">
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                     </span>
                                                </label>
                                            </div>

                                            <form id="remove-activity-form-{{$activity->id}}"
                                                  action="{{url('/admin/activity/'.$activity->id)}}"
                                                  method="POST"
                                                  style="display: none;">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> Last 24 Hours
                        </div>

                    </div>
                </div>


                <div class="row">

                    <div class="col-12 d-flex justify-content-center">

                        {{$activities->links()}}
                    </div>
                </div>


            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4 offset-5">
            <h1>Statistic <i class="material-icons md-36">
                    bar_chart
                </i></h1>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    {{-- isset($mostFollowedUser) ? url('/admin/profile/'.$mostFollowedUser->id) :'/admin/dashboard'--}}
                    <a href="">
                        <img class="img"
                             src="{{url('/storage/'.(isset($mostFollowedUser) ?
                        isset($mostFollowedUser->image) ? $mostFollowedUser->image : 'profile/WmL1pTG3i4SMUmBSCmReweKSoJqvvT5DBJKtfdwa.jpeg' : '/profile/WmL1pTG3i4SMUmBSCmReweKSoJqvvT5DBJKtfdwa.jpeg' ))}}"/>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category">Most followed user</h6>
                    <h4 class="card-title">{{(isset($mostFollowedUser) ? $mostFollowedUser->title : '')}}</h4>
                    <p class="card-description">
                        {{(isset($mostFollowedUser)? $mostFollowedUser->description : '')}}
                    </p>
                    <a class="btn btn-success btn-round">
                        <strong>{{(isset($mostFollowedUser) ? 'followers : '. $mostFollowedUser->numOfFollowers : 'No such user at the moment')}}</strong></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="">
                        <img class="img"
                             src="{{url('/storage/'.(isset($mostLikedPost) ?
                        isset($mostLikedPost->image) ? $mostLikedPost->image : 'posts/no-post.png' : 'posts/no-post.png' ))}}"/>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category">Most liked post</h6>
                    <h4 class="card-title">{{isset($mostLikedPost) ? 'Owner : '.$mostLikedPost->title : ''}}</h4>
                    <p class="card-description">
                        {!! (isset($mostLikedPost) ? $mostLikedPost->caption : '') !!}
                    </p>

                    <a class="btn btn-success btn-round"> {{(isset($mostLikedPost) ? 'likes : '. $mostLikedPost->numOfLikes : 'No such post at the moment')}}</a>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    {{-- isset($mostCommentedPost) ? url('/admin/profile/'.$mostCommentedPost->user->profile->id) :'/admin/dashboard' --}}
                    <a href="">
                        <img class="img"
                             src="{{url('/storage/'.(isset($mostCommentedPost) ?
                        isset($mostCommentedPost->image) ? $mostCommentedPost->image : 'posts/no-post.png' : 'posts/no-post.png' ))}}"/>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category">Most commented post</h6>
                    <h4 class="card-title">{{(isset($mostCommentedPost) ? 'Owner : '. $mostCommentedPost->title : '')}}</h4>
                    <p class="card-description">
                        {!! (isset($mostCommentedPost) ? $mostCommentedPost->caption : '')!!}
                    </p>
                    <a class="btn btn-success btn-round">
                        {{(isset($mostCommentedPost) ? 'comments : '.$mostCommentedPost->numOfComments : 'No such post at the moment')}}</a>
                </div>
            </div>
        </div>


    </div>

    <div class="row mt-3">


        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    {{-- isset($mostLikedComment) ? url('/admin/profile/'.$mostLikedComment->user->profile->id) :'/admin/dashboard' --}}
                    <a href="">
                        <img class="img"
                             src="{{url('/storage/'.(isset($mostLikedComment) ?
                        isset($mostLikedComment->image) ? $mostLikedComment->image : 'profile/WmL1pTG3i4SMUmBSCmReweKSoJqvvT5DBJKtfdwa.jpeg' : '/profile/WmL1pTG3i4SMUmBSCmReweKSoJqvvT5DBJKtfdwa.jpeg' ))}}"/>
                    </a>

                </div>
                <div class="card-body">
                    <h6 class="card-category">Most liked comment</h6>
                    <h4 class="card-title">{{(isset($mostLikedComment) ? 'Owner : '.$mostLikedComment->title : '')}}</h4>
                    <p class="card-description">
                        {!! (isset($mostLikedComment) ? $mostLikedComment->body : '') !!}
                    </p>
                    <a class="btn btn-success btn-round">
                        {{(isset($mostLikedComment) ? 'likes
                        : '.$mostLikedComment->numOfLikes : 'There is no such comment at the moment')}}</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">

                    {{-- isset($mostPostsPublished) ? url('/admin/profile/'.$mostPostsPublished->profile->id) :'/admin/dashboard' --}}
                    <a href="">
                        <img class="img"
                             src="{{url('/storage/'.(isset($mostPostsPublished) ?
                        isset($mostPostsPublished->image) ? $mostPostsPublished->image : 'profile/WmL1pTG3i4SMUmBSCmReweKSoJqvvT5DBJKtfdwa.jpeg' : '/profile/WmL1pTG3i4SMUmBSCmReweKSoJqvvT5DBJKtfdwa.jpeg' ))}}"/>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category">Aggressive poster</h6>
                    <h4 class="card-title">
                        {{(isset($mostPostsPublished) ? $mostPostsPublished->title : '')}}</h4>
                    <p class="card-description">

                    </p>
                    <a class="btn btn-success btn-round">
                        {{(isset($mostPostsPublished) ? 'published posts : '.$mostPostsPublished->numOfPublishedPosts : 'No posts at the moment. ')}}</a>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    {{--isset($mostPostsLiked) ? url('/admin/profile/'.$mostPostsLiked->id) :'/admin/dashboard'--}}
                    <a href="">
                        <img class="img" src="{{url('/storage/'.(isset($mostPostsLiked) ?
                        isset($mostPostsLiked->image) ? $mostPostsLiked->image : 'profile/WmL1pTG3i4SMUmBSCmReweKSoJqvvT5DBJKtfdwa.jpeg' : '/profile/WmL1pTG3i4SMUmBSCmReweKSoJqvvT5DBJKtfdwa.jpeg' ))}}"/>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category">Big lover</h6>
                    <h4 class="card-title">{{isset($mostPostsLiked) ? $mostPostsLiked->title : ''}}</h4>
                    <p class="card-description">

                    </p>
                    <a class="btn btn-success btn-round">
                        {{(isset($mostPostsLiked) ? 'liked posts : '.$mostPostsLiked->numOfLikedPosts : 'No posts at the moment. ')}}
                    </a>
                </div>
            </div>
        </div>

    </div>


@endsection
