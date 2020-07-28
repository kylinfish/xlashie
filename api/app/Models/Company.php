<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "companies";

    protected $fillable = ['id', 'enabled', 'created_at', 'u[updated_at', 'deleted_at'];
}
