<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "companies";

    protected $fillable = [
        'name',
        'owner_id',
        'account',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'owner_id', 'id');
    }

    public function menu()
    {
        return $this->hasMany('App\Models\Menu', 'company_id', 'id')->orderBy('id', 'asc');
    }
}
