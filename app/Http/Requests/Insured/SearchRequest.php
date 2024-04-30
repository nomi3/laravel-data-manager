<?php

namespace App\Http\Requests\Insured;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'max:255',
            'last_name_kana' => 'max:255',
            'first_name_kana' => 'max:255',
            'email' => 'max:255',
            'insurance_card_number' => 'max:255',
            'insurance_card_symbol' => 'max:255',
        ];
    }
}
