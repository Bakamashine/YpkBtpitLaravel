<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeedbackRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'uuid', 'exists:users,id'],
            'comment' => ['sometimes', 'string', 'max:1500'],
            'raiting' => ['sometimes', 'integer', 'min:1', 'max:5'],
            'image_path' => ['nullable', 'string'],
        ];
    }
}
