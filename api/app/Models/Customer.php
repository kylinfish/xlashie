<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = ['user_id', 'uuid', "name", "phone", "cellphone", "gender", "address", "birth", "note_1", "note_2", "email", "avatar", "identify_id", "identify_provider"];

    protected $hidden = ['id', 'password'];

    protected $dates = ['updated_at', 'created_at'];

    #protected $guarded = ['uuid'];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function inventory()
    {
        return $this->hasMany('App\Models\CustomerInventory', 'customer_id', 'id');
    }

    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket', 'customer_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany('App\Models\InvNote', 'customer_id', 'id');
    }
}
