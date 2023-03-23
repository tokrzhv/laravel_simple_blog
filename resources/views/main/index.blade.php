@extends('layouts.app')
@section('content')

    <!-- Page content-->
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div id="{{ $post->id }}showaction" class="col-lg-4">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        @auth()
                            <div id="{{$post->id}}action" style="display: none;">
                                <div class="d-flex justify-content-end">
                                    <div class="position-absolute ">
                                        <a href="{{ route('post.edit', $post->id) }}" style="text-decoration: none">
                                            <i class="fas fa-pencil-alt fa-2x my-2 mx-2 text-info"></i>
                                        </a>
                                        <button class="btn btn-transparent"
                                                onclick="deletePost({{ $post }})">
                                            <i class="fas fa-trash-alt fa-2x my-2 mx-2 text-danger"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @push('other-scripts')
                                <script>
                                    $(document).ready(function () {
                                        $('#{{$post->id}}showaction').hover(function () {
                                            $('#{{$post->id}}action').show();
                                        }, function () {
                                            $('#{{$post->id}}action').hide();
                                        });
                                    });
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
                                                    success: function (){
                                                        Swal.fire(
                                                            'Deleted!',
                                                            'Post has been deleted.',
                                                            'success'
                                                        )
                                                        setTimeout(function () {
                                                            window.location.reload();
                                                        }, 2000);
                                                    }
                                                })
                                            }
                                        })
                                    }
                                </script>
                            @endpush
                        @endauth

                        <a href="#">
                            <img class="card-img-top " style="height: 300px"
                                 src="{{url($post->main_image ? 'storage/'. $post->main_image : 'storage/doesnotexist.jpg')}}"
                                 alt="blog post">
                        </a>

                        <div class="card-body">
                            <div class="small text-muted">{{ $post->formattedCreatedAt() }}</div>
                            <h2 class="card-title h4">{{ $post->title }}</h2>
                            <p class="card-text">{{ $post->content }}</p>
                            <a class="btn text-white" style="background-color: #4c75a3;"
                               href="{{ route('post.show', $post->id) }}">Read more →</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <hr class="my-1"/>
        </div>

        <!-- Pagination-->
        <div class="row">
            <div class="mx-auto my-3">
                {{ $posts->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection


