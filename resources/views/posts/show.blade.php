@extends('layouts.front.master')

@section('content')

    <div class="container">

        <div class="row">

            @include('posts.partials.image')

            @include('posts.partials.details')

        </div>

    </div>
@endsection
