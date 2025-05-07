<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mbrand_prod extends Model
{
    protected $fillable = [
        'ccode',
        'cname',
        'trs',
        'clogo',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
    ];
}
