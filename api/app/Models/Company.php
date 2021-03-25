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
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function menu()
    {
        return $this->hasMany(Menu::class, 'company_id', 'id');
    }

    public function customer()
    {
        return $this->hasMany(Customer::class, 'company_id', 'id');
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class, 'company_id', 'id');
    }
}
