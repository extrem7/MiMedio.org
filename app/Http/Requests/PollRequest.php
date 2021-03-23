<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'question' => ['required', 'string'],
            'answers' => ['required', 'array', 'min:2'],
            'answers.*' => ['required', 'string', 'distinct']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
