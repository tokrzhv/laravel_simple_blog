<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\ApiGetRequest;
use App\Http\Requests\Api\Post\ApiStoreRequest;
use App\Http\Requests\Api\Post\ApiUpdateRequest;
use App\Http\Resources\MetaPostResource;
use App\Http\Resources\ShowPostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ApiGetRequest $request)
    {
        try {
            $data = $request->validated();
            $page = $data['page'] ?? 1;
            $count = $data['count'] ?? 10;

            $posts = Post::paginate($count, ['*'], 'page', $page);

            return response()->json(new MetaPostResource($posts), 200);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApiStoreRequest $request)
    {
        try {
            $data = $request->validated();

            if (isset($data['main_image'])) {
                $data['main_image'] = $request->file('main_image')->store('images', ['disk' => 'public']);
            }

            $post = Post::create($data);

            return response()->json([
                'success' => true,
                'post_id' => $post->id,
                'message' => "New post successfully registered"
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try {
            $request->merge(['post_id' => $id]);
            $validatedId = Validator::make($request->all(),
                [
                    'post_id' => 'integer|min:1',
                ]);

            if ($validatedId->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'fails' => $validatedId->errors()
                ], 400);
            }

            $post = Post::where('id', $id)->first();

            if ($post == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'The post with the requested identifier does not exist',
                    'fails' => [
                        'post_id' => [
                            'Post not found',
                        ]
                    ],
                ], 404);
            }
            return response()->json(new ShowPostResource($post), 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApiUpdateRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $post = Post::find($id);

            if ($post == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'The post with the requested identifier does not exist',
                    'fails' => [
                        'post_id' => [
                            'Post not found',
                        ]
                    ],
                ], 404);
            }

            if (isset($data['main_image']) && isset($post->main_image)) {
                Storage::disk('public')->delete($post->main_image);
                $data['main_image'] = $request->file('main_image')->store('images', ['disk' => 'public']);
            } else if (isset($data['main_image'])) {
                $data['main_image'] = $request->file('main_image')->store('images', ['disk' => 'public']);
            }

            $post->update($data);

            return response()->json([
                'success' => true,
                'post_id' => $post->id,
                'message' => "New post successfully updated"
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $request->merge(['post_id' => $id]);
            $validatedId = Validator::make($request->all(),
                [
                    'post_id' => 'integer|min:1',
                ]);

            if ($validatedId->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'fails' => $validatedId->errors()
                ], 400);
            }

            $post = Post::find($id);

            if ($post == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'The post with the requested identifier does not exist',
                    'fails' => [
                        'post_id' => [
                            'Post not found',
                        ]
                    ],
                ], 404);
            }

            if (isset($post->main_image)) {
                Storage::disk('public')->delete($post->main_image);
            }

            $post->delete();

            return response()->json([
                'success' => true,
                'post_id' => $post->id,
                'message' => "Post deleted successfully!",
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Page not found'
            ], 404);
        }
    }
}
