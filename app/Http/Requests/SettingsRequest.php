<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingsRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,bmp,png'],
        ];
        if ($this->user()->has_password) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,id,' . $this->user()->id];
        }
        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }
}
