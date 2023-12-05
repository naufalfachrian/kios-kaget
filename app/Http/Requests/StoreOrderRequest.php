<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'recipient_name' => 'required|string',
            'address' => 'required|string',
            'sub_district_id' => 'required|exists:sub_districts,id',
            'district_id' => 'required|exists:districts,id',
            'city_id' => 'required|exists:cities,id',
            'province_id' => 'required|exists:provinces,id',
            'postal_code' => 'required|exists:postal_codes,postal_code',
            'phone_number' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'landmark' => '',
            'session_id' => 'required|exists:carts,session_id'
        ];
    }
}
