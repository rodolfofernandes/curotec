<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ProductIndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => 'sometimes|string|max:50',
            'color'       => 'sometimes|string|max:100',
            'price_min'   => 'sometimes|numeric|min:0',
            'category_id' => 'sometimes|integer|exists:categories,id',
            'per_page'    => 'sometimes|integer|min:1|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.string'        => 'The name must be a string.',
            'color.string'       => 'The color must be a string.',
            'price_min.numeric'  => 'The minimum price must be a number.',
            'category_id.integer' => 'The category ID must be an integer.,',
        ];
    }

    public function filters()
    {
        return [
            'name'        => 'trim|escape',
            'color'       => 'trim|escape',
            'price_min'   => 'trim|escape',
            'category_id' => 'trim|escape',            
        ];
    }

  protected function failedValidation(Validator $validator)
{
    $response = response()->json([
        'message' => 'Validation failed',
        'errors' => $validator->errors(),
    ], 422);

    throw new ValidationException($validator, $response);
}

}