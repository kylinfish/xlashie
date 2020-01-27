<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = ['shop_id', 'name', 'email', 'gender', 'birth', 'avatar', 'line', 'fb', 'phone', 'note'];

    protected $hidden = ['id', 'password', 'shop_id'];

    protected $guarded = ['uuid'];
}
