<?php

namespace App\Http\Requests\Post;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:15|unique:posts,title',
            'content' => 'required|string|min:15|max:50',
            'description' => 'required|string|min:25|max:255',
            'main_image' => 'file|mimes:jpg,png|max:5120',
        ];

    }
}
