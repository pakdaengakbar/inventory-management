<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_staff extends Model
{
    protected $table = 'web_staff';
    protected $fillable = [
        'ccategory_id',
        'cname',
        'caddress',
        'cphone',
        'cwebsite',
        'cemail',
        'cposition',
        'cexpertise',
        'cimage',
        'cstatus',
        'cplace_birth',
        'ddate_birth',
        'dpost_date',
        'ccreate_by',
        'cupdate_by',
        'cpath',
        'ncompanie_id',
        'nregion_id',
    ];
}
