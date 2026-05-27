<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreApiProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ProductName' => 'required|string',
            'YpkId' => 'required|exists:ypks,id',
            'StatusProductId' => 'required|exists:status_products,id',
            'ProductCost' => 'required|string',
            'ProductInfo' => 'required|string',
            'IsProduct' => 'required|boolean',
            'Photo' => 'nullable|image|mimetypes:image/jpeg,image/jpg,image/png,image/webp',
            'Address' => 'required|string'
        ];
    }
}
