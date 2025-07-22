<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'stock'];

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}