<?php

namespace App\Http\Requests\StatusOrder;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status_name' => ['sometimes', 'string'],
        ];
    }
}
