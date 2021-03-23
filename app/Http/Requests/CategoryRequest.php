<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'slug' => [
                'nullable',
                'max:255',
                Rule::unique('categories')->ignore($this->request->get('slug'), 'slug')
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
