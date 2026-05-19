<?php

namespace App\Http\Requests\StatusProduct;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status_name' => ['sometimes', 'string'],
        ];
    }
}
