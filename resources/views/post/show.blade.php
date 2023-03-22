@extends('layouts.app')
@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mb-3">
                <div class="card mb-3">
                    <a href="#">
                        <img class="card-img-top img-fluid"
                             src="{{asset($post->main_image ? 'storage/'. $post->main_image : 'storage/images/doesnotexist.jpg')}}"
                             alt="Responsive image">
                    </a>
                    <div class="card-body">
                        <div class="small text-muted">{{ $post->formattedCreatedAt() }}</div>
                        <div class="">
                            <h2 class="card-title d-flex justify-content-center">{{ $post->title }}</h2>
                            <p class="card-text d-flex justify-content-center">{{ $post->content }}</p>
                            <p class="card-text">{{ $post->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-start">
                        <a class="btn text-white mx-2" style="background-color: #4c75a3;"
                           href="{{ route('main.index')}}"
                           role="button">
                            <i class="fas fa-backward me-3"></i>
                            Back
                        </a>
                    </div>
                    @auth()
                        <div id="showaction" class="d-flex justify-content-end">
                            <a class="btn text-white mx-2 bg-info" href="{{ route('post.edit', $post->id) }}"
                               role="button">
                                <i class="fas fa-pencil-alt me-3"></i>
                                Edit
                            </a>
                            <button class="btn text-white mx-2 bg-danger"
                                    onclick="deletePost({{ $post }})">
                                <i class="fas fa-trash-alt me-3"></i>
                                Delete
                            </button>
                            @push('other-scripts')
                                <script>
                                        function deletePost(post) {
                                            Swal.fire({
                                                title: 'Are you sure?',
                                                text: "You won't be able to revert this!",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Yes, delete it!'
                                            }).then((result) => {
                                                if (result.isConfirmed) {

                                                    let url = '{{ route("post.destroy", ":id") }}'
                                                    url = url.replace(":id", post.id)

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: url,
                                                        data: {
                                                            '_method': 'DELETE',
                                                            '_token': '{{ csrf_token()}}'
                                                        },
                                                        success: function () {
                                                            Swal.fire(
                                                                'Deleted!',
                                                                'Post has been deleted.',
                                                                'success'
                                                            )
                                                            setTimeout(function () {
                                                                window.location.href = "{{ route('main.index') }}";
                                                            }, 2000);
                                                        }
                                                    })
                                                }
                                            })
                                        }
                                </script>
                            @endpush
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
