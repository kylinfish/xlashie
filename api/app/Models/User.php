<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";

    protected $fillable = [
        'uuid',
        'name',
        'password',
        'phone',
        'email',
        'gender',
        'status',
        'birth',
        'avatar',
        'fb',
    ];

    protected $hidden = [];

    protected $guarded = [];

    protected $attrubutes = [
        'password' => '',
        'phone' => '',
    ];

    public function shop()
    {
        return $this->belongsToMany('App\Models\Shop');
    }
}
