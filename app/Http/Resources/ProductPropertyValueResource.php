<?php

namespace App\Http\Resources;

use App\Models\ProductProperty;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductPropertyValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $property = $this->property()->first(); //todo каждый раз запрос делает, по-другому сделать надо бы

        return [
            'property_id' => $property->id,
            'title' => $property->title,
            'value' => (int)$this->value,
        ];
    }
}
