<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    
    public function accountOrder()
    {
        return $this->belongsTo(AccountOrderProfile::class);
    }
}
