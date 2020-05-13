<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChannelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'slug' => 'nullable|string|min:3|unique:users,slug,' . auth()->id(),
            'embed' => 'nullable|array',
            'embed.*' => 'nullable|string',
            'logo' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,bmp,png'],
            'color' => 'nullable|string|size:6'
        ];
    }
}
