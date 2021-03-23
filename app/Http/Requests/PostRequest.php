<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        $types = implode(',', Post::$statuses);

        return [
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'body' => ['required', 'string'],
            'excerpt' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048|mimes:jpg,jpeg,bmp,png'],
            'status' => ["in:$types','nullable"],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
