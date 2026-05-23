<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидация запроса на обновление товара/услуги.
 */
class UpdateProductRequest extends FormRequest
{
    /**
     * Разрешить выполнение запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации для обновления товара/услуги.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|string',
            'ypk_id' => 'required|exists:ypks,id',
            'status_product_id' => 'required|exists:status_products,id',
            'product_cost' => 'required|string',
            'product_info' => 'required|string',
            'is_product' => 'required|boolean',
            'photo_path' => 'nullable|image|mimetypes:image/jpeg,image/jpg,image/png,image/webp',
            'address' => 'required|string'
        ];
    }
}
