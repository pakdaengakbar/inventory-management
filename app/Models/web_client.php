<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_client extends Model
{
    protected $table = 'web_client';
    protected $fillable = [
        'ctype',
        'cname',
        'cLeader',
        'caddress',
        'cphone',
        'cwebsite',
        'cemail',
        'ctestimonials',
        'cimage',
        'cstatus',
        'cplace_birth',
        'ddate_birth',
        'dpost_date',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
    ];
}
