@extends('layouts.front.master')

@section('content')
    <!-- Author section -->
    <div class="container">
        <div class="row">

            @include('layouts.front.partials.author_sidebar')

            <div class="col-md-4">

                <div class="p-3 pt-5">
                    <div style="text-align: center">
                        <h4 class="font-weight-bold">About me</h4>
                        <p class="author-desc pt-3">My name is Aleksa Bjeličić and i am at the final year of studies. I
                            study IT, obviously, and am interested in technology of software development, web
                            programming, design etc.
                            I'm at the age of 22 and i'm attending "Visoka ICT".
                        </p>
                    </div>

                </div>
                <hr class="b-shadow">
                <div class="mt-2 p-3">
                    <div style="text-align: center">
                        <h4 class="font-weight-bold">About project</h4>
                        <p class="author-desc pt-3">The project represents the copy of an Instagram social network and
                            some of his features like publishing a post, leaving a comment, following other profiles,
                            like functionality for posts and comments, etc.
                            Hope you will like it, enjoy !
                        </p>
                    </div>

                </div>
                <hr class="b-shadow">
                <div class="mt-2 p-3 footer-widget">
                    <div>
                        <h4 style="text-align: center" class="font-weight-bold">Socials</h4>
                        <ul class="pt-3">
                            <li><a href="{{url('https://github.com/bjelic97')}}"><i class="fa fa-github"
                                                                                    aria-hidden="true"></i> | GitHub</a>
                            </li>
                            <li><a href="{{url('https://www.linkedin.com/in/aleksa-bjelicic-4782211a3')}}"><i
                                        class="fa fa-linkedin" aria-hidden="true"></i> | LinkedIn</a></li>
                            <li><a href="{{url('https://www.facebook.com/aleksa.bjelicic')}}"><i class="fa fa-facebook"
                                                                                                 aria-hidden="true"></i>
                                    | Facebook</a></li>
                        </ul>
                    </div>

                </div>


            </div>


        </div>
    </div>
    <!-- Author section end -->
@endsection
