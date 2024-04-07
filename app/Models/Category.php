<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function set()
    {
        return $this->belongsTo(Set::class);
    }
    public function products()
    {
        return $this->belongsToMany(Producte::class , 'category_productes' , 'category_id' , 'product_id');
    }
}
