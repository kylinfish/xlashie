<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = "menus";

    protected $fillable = [];

    protected $hidden = [];

    protected $guarded = [];

    protected $attributes = [];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
