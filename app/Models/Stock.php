<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Producte;

class Stock extends Model
{
    use SoftDeletes;
    protected $fillable = ['quantity'];
    public function products()
    {
        return $this->belongsTo(Producte::class , 'product_id');
    }
}
