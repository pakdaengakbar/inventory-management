<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mbrand_type extends Model
{
    protected $fillable = [
        'cname',
        'cstatus',
        'ccreate_by',
        'cupdate_by',
    ];
}
