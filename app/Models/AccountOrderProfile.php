<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountOrderProfile extends Model
{
    protected $table = 'account_order_profile';
    public function account()
    {
        return $this->hasMany(Account::class , 'id', 'account_id');
    }
    public function order()
    {
        return $this->hasMany(Order::class , 'id');
    }
}
