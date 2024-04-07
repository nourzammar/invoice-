<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function cardProduct()
    {
        return $this->hasMany(CardProduct::class , 'card_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
