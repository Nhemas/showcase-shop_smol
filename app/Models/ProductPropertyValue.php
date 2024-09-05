<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPropertyValue extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function property() {
        return $this->belongsTo(ProductProperty::class);
    }
}
