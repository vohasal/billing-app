<?php

namespace App\Http\Requests;

use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
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

        $userId = $this->user()->id;
        return [
            'amount' => ['required', 'numeric', 'min:0'],
            'date' => ['required', 'date'],
            'description' => ['required', 'nullable', 'string'],
            'category_id' => ['required', 'integer', Rule::exists(Category::class, 'id')],
            'account_id' => ['required', 'integer',
                Rule::exists(Account::class, 'id')->where(function ($query) use ($userId){
                    return $query->where('user_id', $userId);
                })
            ],
            'currency_id' => ['required', 'integer', Rule::exists(Currency::class, 'id')]
        ];
    }

    public function messages(): array
    {
        return [
            'account_id.exists' => 'Вы не можете использовать этот счет, он чужой'
        ];

    }
}
