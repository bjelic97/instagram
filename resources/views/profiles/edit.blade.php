@extends('layouts.front.master')

@section('content')
    <div class="container">
        <form action="{{url('/profile/'.$user->id)}}" method="POST" enctype="multipart/form-data">

            {{csrf_field()}}
            @method('PATCH')

            <div class="row">

                <div class="col-8 offset-2">
                    <div class="form-group row ">
                        <label for="caption" class="col-md-4 col-form-label text-md-right"></label>
                        <div class="col-md-6 b-shadow logo">
                            <h1 class="mt-4 text-center">Edit Profile</h1>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label text-md-right"></label>
                        <div class="col-md-6" style="text-align: center">
                            <img id='img-upload' src="{{url($user->profile->profileImage())}}"/>

                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">Profile image</label>

                        <div class="col-md-6">

                            <div class="input-group">
                             <span class="input-group-btn">
                                 <span class="btn btn-default btn-file">
                                     Browse…  <input id="image" type="file"
                                                     name="image"
                                                     value="{{ old('image') }}" autocomplete="username">

                                 </span>
                             </span>

                                <input type="text" class="form-control" readonly>

                            </div>

                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Profile name</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" value="{{ old('title') ?? $user->profile->title}}" autocomplete="title">

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                        <div class="col-md-6">
                            <input id="description" type="text"
                                   class="form-control @error('description') is-invalid @enderror"
                                   name="description" value="{{ old('description') ?? $user->profile->description}}"
                                   autocomplete="username">

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label text-md-right">URL</label>

                        <div class="col-md-6">
                            <input id="url" type="text" class="form-control @error('url') is-invalid @enderror"
                                   name="url" value="{{ old('url') ?? $user->profile->url  }}" autocomplete="username">

                            @error('url')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right"></label>

                        <div class="col-md-6">
                            <button class="btn btn-primary w-100">Save Profile</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
