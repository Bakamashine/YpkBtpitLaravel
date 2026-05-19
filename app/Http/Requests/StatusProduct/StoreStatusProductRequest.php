<?php

namespace App\Http\Requests\StatusProduct;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatusProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status_name' => ['required', 'string'],
        ];
    }
}
