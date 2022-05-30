<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
