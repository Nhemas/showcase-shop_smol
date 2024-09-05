<?php

namespace App\Http\Filters;

use App\Models\ProductProperty;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    protected function getCallbacks(): array
    {
        return [
            'price_min' => [$this, 'priceMin'],
            'price_max' => [$this, 'priceMax'],
            'properties' => [$this, 'properties'],
        ];
    }

    public function properties(Builder $builder, array $properties)
    {
        $allProperties = ProductProperty::all('id', 'title');
        $propertyIdsByTitle = [];
        foreach ($allProperties as $property) {
            $propertyIdsByTitle[$property->title] = $property->id;
        }

        foreach ($properties as $propertyName => $propertyValues) {
            if (empty($propertyIdsByTitle[$propertyName]))
                continue;
            $propertyId = $propertyIdsByTitle[$propertyName];

            $builder->whereHas('propertyValues', function ($query) use ($propertyId, $propertyValues) {
                $query->where('property_id', $propertyId)
                    ->whereIn('value', $propertyValues);
            });
        }
    }

    public function priceMin(Builder $builder, float $value)
    {
        $builder->where('price', '>=', $value);
    }

    public function priceMax(Builder $builder, float $value)
    {
        $builder->where('price', '<=', $value);
    }
}
