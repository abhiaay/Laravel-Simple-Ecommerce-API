<?php

namespace App\Http\Requests\Api\Web;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer'],
            'category_id' => ['required', 'exists:product_categories,_id'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image'],
            'thumbnail' => ['nullable', 'image']
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'category'
        ];
    }
}
