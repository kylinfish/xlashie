<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = ['user_id', 'uuid', 'name', 'email', 'gender', 'birth', 'avatar', 'line', 'fb', 'phone', 'note'];

    protected $hidden = ['id', 'password'];

    protected $dates = ['updated_at', 'created_at'];

    #protected $guarded = ['uuid'];
}
