<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producte extends Model
{
    
    use SoftDeletes;
    
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function cardProduct()
    {
        return $this->hasMany(CardProduct::class , 'card_productes', 'product_id', );
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_productes', 'product_id', 'category_id');
    }
}
