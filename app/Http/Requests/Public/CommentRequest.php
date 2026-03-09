<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'commentable_type' => ['required', Rule::in(['product', 'post'])],
            'commentable_id' => ['required', 'integer', 'min:1'],
            'content' => ['required', 'string', 'min:3'],
        ];
    }
}
