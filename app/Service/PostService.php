<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            if (isset($data['main_image'])) {
                $data['main_image'] = Storage::disk('public')->put('images', $data['main_image']);
            }
            Post::firstOrCreate($data);
            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $post)
    {
        try {
            DB::beginTransaction();

            if (isset($data['main_image']) && isset($post->main_image)) {
                Storage::disk('public')->delete($post->main_image);
                $data['main_image'] = Storage::disk('public')->put('images', $data['main_image']);

            } else if (isset($data['main_image'])) {
                $data['main_image'] = Storage::disk('public')->put('images', $data['main_image']);
            }

            $post->update($data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

}
