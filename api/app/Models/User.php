<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "users";

    protected $fillable = [
        'uuid',
        'name',
        'company_id',
        'identify_provider',
        'identify_id',
        'is_demo',
        'password',
        'phone',
        'email',
        'gender',
        'status',
        'birth',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guarded = [];

    protected $attributes = [
        'password' => '',
        'phone' => '',
        'identify_id' => '',
        'identify_provider' => '',
        'birth' => null,
    ];

    public function company()
    {
        return $this->hasOne(Company::class, 'owner_id');
    }
}
