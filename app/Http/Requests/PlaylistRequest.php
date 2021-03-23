<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaylistRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'videos.*.title' => ['required'],
            'videos.*.id' => ['required']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
