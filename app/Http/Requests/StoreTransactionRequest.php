<?php

namespace App\Http\Requests;

use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
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
            'amount' => ['required', 'numeric', 'min:0'],
            'date' => ['required', 'date'],
            'description' => ['required', 'nullable', 'string'],
            'category_id' => ['required', 'integer', Rule::exists(Category::class, 'id')],
            'account_id' => ['required', 'integer', Rule::exists(Account::class, 'id')],
            'currency_id' => ['required', 'integer', Rule::exists(Currency::class, 'id')]
        ];
    }
}
