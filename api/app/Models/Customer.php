<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = [
        'company_id',
        'uuid',
        "name",
        "phone",
        "cellphone",
        "gender",
        "address",
        "birth",
        "note_1",
        "note_2",
        "email",
        "avatar",
        "identify_id",
        "identify_provider",
        "charged_by"
    ];

    protected $hidden = ['id', 'password'];

    protected $dates = ['updated_at', 'created_at'];

    #protected $guarded = ['uuid'];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function inventory()
    {
        return $this->hasMany(CustomerInventory::class, 'customer_id', 'id');
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class, 'customer_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany(InvNote::class, 'customer_id', 'id');
    }

    // phpcs:disable PSR1.Methods.CamelCapsMethodName
    public function charged_by_user()
    {
        return $this->belongsTo(User::class, 'charged_by', 'id');
    }
}
