<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mbrand_group extends Model
{
    protected $fillable = [
        'ccode',
        'cname',
        'cnotes',
        'cstatus',
        'ccreate_by',
        'cupdate_by',
    ];
}
