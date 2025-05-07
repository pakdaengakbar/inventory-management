<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mbrand_model extends Model
{
    protected $fillable = [
        'cbrand_type',
        'cbrand_model',
        'cdescription',
        'ctype',
        'cstatus',
        'ccreate_by',
        'cupdate_by',
    ];
}
