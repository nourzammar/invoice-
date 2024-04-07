<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    public function card()
    {
        return $this->belongsTo(Card::class);
    }
    public function accountOrder()
    {
        return $this->belongsTo(AccountOrderProfile::class);
    }
}
