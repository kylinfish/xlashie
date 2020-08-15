<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvNote extends Model
{
    protected $table = "customer_notes";

    protected $fillable = ['customer_id', 'company_id', 'note', 'title', 'inventory_id', 'updated_at', 'created_at', 'deleted_at'];
}
