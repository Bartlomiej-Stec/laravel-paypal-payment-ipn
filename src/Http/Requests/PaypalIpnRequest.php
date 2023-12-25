<?php

namespace Barstec\Paypal\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class PaypalIpnRequest extends FormRequest
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
            'custom' => ['required', 'string', 'exists:' . config('paypal.table_name') . ',id'],
            'mc_gross' => ['required', 'numeric'],
            'tax' => ['required', 'numeric'],
            'shipping' => ['required', 'numeric'],
            'mc_currency' => ['required', 'string', 'size:3']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        abort(403);
    }
}
