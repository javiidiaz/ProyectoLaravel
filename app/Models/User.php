<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role'];

    // Un usuario puede tener muchos pedidos
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

