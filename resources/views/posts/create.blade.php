@extends('layouts.front.master')

@section('content')
    <div class="container">
        <form action="{{url('/p')}}" method="POST" enctype="multipart/form-data">

            {{csrf_field()}}
            <div class="row">

                <div class="col-8 offset-2">

                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label text-md-right"></label>
                        <div class="col-md-6 b-shadow logo" style="text-align: center">
                            <h1 class="mt-4">New Post</h1>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label text-md-right"></label>
                        <div class="col-md-6" style="text-align: center">
                            <img id='img-upload' src="{{url('/storage/posts/no-post.png')}}"/>

                        </div>

                    </div>


                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>

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
                        <label for="caption" class="col-md-4 col-form-label text-md-right">Caption</label>

                        <div class="col-md-6">

                            <textarea class="summernote form-control"
                                      name="caption" value="{{ old('caption') }}"></textarea>

                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right"></label>

                        <div class="col-md-6">
                            <button class="btn btn-primary w-100">Add New Post</button>
                        </div>
                    </div>

                    <div class="col-md-6 offset-5">
                        @include('layouts.messages.errors')
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
