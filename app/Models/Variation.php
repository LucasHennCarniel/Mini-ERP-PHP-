<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    protected $fillable = ['product_id', 'name', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
