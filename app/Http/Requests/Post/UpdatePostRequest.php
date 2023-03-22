<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:15',
            'content' => 'required|string|min:15|max:50',
            'description' => 'required|string|min:25|max:255',
            'main_image' => 'nullable|file|mimes:jpg,png|max:5120',
        ];
    }
}
