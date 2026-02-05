<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Transaction $resource
 */

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'amount' => $this->resource->amount,
            'date' => $this->resource->date,
            'description' => $this->resource->description,
            'category_id' => $this->resource->category_id,
            'account_id' => $this->resource->account_id,
            'currency_id' => $this->resource->currency_id,
            "created_at" => $this->resource->created_at->toDateTimeString(),
            "updated_at" => $this->resource->updated_at->toDateTimeString()
        ];
    }
}
