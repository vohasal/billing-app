<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Category $resource
 */

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'type' => $this->resource->type,
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString()
        ];
    }
}
