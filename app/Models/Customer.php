<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use App\Traits\Uuid;

class Customer extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, Uuid;

    protected $table = "customers";

    protected $fillable = ['shop_id', 'name', 'email', 'gender', 'birth', 'avatar', 'line', 'fb', 'phone', 'note'];

    protected $hidden = ['id', 'password', 'shop_id'];

    protected $guarded = ['uuid'];
}
