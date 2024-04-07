<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardProduct extends Model
{
    protected $table = 'card_productes';

    public function card()
    {
        return $this->belongsToMany(Card::class, 'card_productes');
    }

    public function product()
    {
        return $this->belongsToMany(Producte::class, 'card_productes');
    }
}
