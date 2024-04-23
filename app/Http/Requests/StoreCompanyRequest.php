<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'company' => 'required|string|max:255',
            'cnpj' => 'required|cnpj|unique:company|max:14',
            'gateways' => 'required|array',
            'gateways.*.name_gateway' => 'required|string',
            'gateways.*.public_key' => 'required|string',
            'gateways.*.live_api_key' => 'required|string',
            'gateways.*.recipient_id' => 'required|string',
        ];
    }
}
