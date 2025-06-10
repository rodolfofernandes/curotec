<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{   public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function validateStep(Request $request)
    {
        $step = $request->input('step');
        $rules = [
            1 => [
                'name' => 'required|string|max:100',
                'category_id' => 'required|exists:categories,id',
                'color' => 'required|string|max:50',
                'stock' => 'required|integer|min:0',
            ],
            2 => [
                'price' => 'required|numeric|min:0',
                'has_discount' => 'required|boolean',
            ],
            3 => [
                'discount_value' => 'required_if:has_discount,1|numeric|min:0|max:' . $request->input('price', 0),
            ],
        ];

        $messages = [
            'name.required' => 'Product name is required.',
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'Selected category does not exist.',
            'color.required' => 'Color is required.',
            'stock.required' => 'Stock is required.',
            'stock.integer' => 'Stock must be an integer.',
            'stock.min' => 'Stock must be at least 0.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price must be at least 0.',
            'has_discount.required' => 'Discount selection is required.',
            'has_discount.boolean' => 'Discount selection must be Yes or No.',
            'discount_value.required_if' => 'Discount value is required if discount is selected.',
            'discount_value.numeric' => 'Discount value must be a number.',
            'discount_value.min' => 'Discount value must be at least 0.',
            'discount_value.max' => 'Discount value cannot be greater than the price.',
        ];

        $validator = Validator::make($request->all(), $rules[$step] ?? [], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        // Final validation
        $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'color' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'has_discount' => 'required|boolean',
            'discount_value' => 'required_if:has_discount,1|numeric|min:0|max:' . $request->input('price', 0),
        ], [
            'name.required' => 'Product name is required.',
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'Selected category does not exist.',
            'color.required' => 'Color is required.',
            'stock.required' => 'Stock is required.',
            'stock.integer' => 'Stock must be an integer.',
            'stock.min' => 'Stock must be at least 0.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price must be at least 0.',
            'has_discount.required' => 'Discount selection is required.',
            'has_discount.boolean' => 'Discount selection must be Yes or No.',
            'discount_value.required_if' => 'Discount value is required if discount is selected.',
            'discount_value.numeric' => 'Discount value must be a number.',
            'discount_value.min' => 'Discount value must be at least 0.',
            'discount_value.max' => 'Discount value cannot be greater than the price.',
        ]);

        Product::create($request->all());

        return redirect()->route('products.create')->with('success', 'Product registered successfully!');
    }
}