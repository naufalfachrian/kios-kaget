<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() &&
            Auth::user()->hasPermission(Permission::$ADMINISTRATOR_ACCESS) &&
            Auth::user()->hasPermission(Permission::$PRODUCT_MASTER);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'nullable|exists:products,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ];
    }
}
