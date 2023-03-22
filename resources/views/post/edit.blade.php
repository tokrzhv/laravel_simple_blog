@extends('layouts.app')
@section('content')
    <section class="mb-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">

                    <h2 class="text-dark mb-4">Update the <n class="font-monospace text-info">{{ $post->title }}</n> post</h2>

                    <div class="card" style="border-radius: 15px;">
                        <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Title</h6>
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <input type="text" name='title' class="form-control form-control-lg"
                                               value="{{ old('title') ?  old('title') : $post->title }}"/>
                                        @error('title')
                                        <div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Content</h6>
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <input type="text" name="content" class="form-control form-control-lg"
                                               placeholder="some content"
                                               value="{{ old('content') ? old('content') : $post->content }}"/>
                                        @error('content')
                                        <div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Description</h6>
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <textarea class="form-control" name='description'
                                                  placeholder="Description of your posts" style="max-height: 150px">
                                            {{ old('description') ? old('description') : $post->description }}
                                        </textarea>
                                        @error('description')
                                        <div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="text-center my-2">
                                        <img class="card-img-top w-50" style="height: 300px"
                                             src="{{asset($post->main_image ? 'storage/'. $post->main_image : 'storage/images/doesnotexist.jpg')}}"
                                             alt="main_image">
                                    </div>
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Upload new image</h6>
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <input type="file" name='main_image' class="form-control form-control-lg"
                                               id="formFileLg"/>
                                        <div class="small text-muted mt-2">Upload your image or any other relevant file.
                                            Max file
                                            size 5 MB
                                        </div>
                                        @error('main_image')
                                        <div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="px-5 py-4">
                                    <button type="submit" class="btn btn-success btn-lg">Update application</button>

                                    <a class="btn btn-info btn-lg mx-4" href="{{ URL::previous()}}"
                                       role="button">
                                        Cancel
                                    </a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
