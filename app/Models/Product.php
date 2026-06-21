<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'image',
        'stock',
        'capital_price',
        'selling_price',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
