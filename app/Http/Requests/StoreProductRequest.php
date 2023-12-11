<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission(Permission::$PRODUCT_MASTER);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_images' => 'required|array',
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => '',
            'weight_in_grams' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
