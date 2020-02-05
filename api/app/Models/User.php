<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";

    protected $fillable = ['name', 'status'];

    protected $hidden = [];

    protected $guarded = ['uuid'];

    public function shop()
    {
        return $this->belongsToMany('App\Models\Shop');
    }
}
