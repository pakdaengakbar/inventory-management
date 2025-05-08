<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mcustomer extends Model
{
    protected $fillable = [
        'cstatus',
        'ccode',
        'cname',
        'caddress1',
        'caddress2',
        'cphone',
        'cmobile',
        'cemail',
        'cfax',
        'nlimit_received',
        'nmax_invoice',
        'nblock_duedate',
        'ccity',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'cregion_id',
    ];
}
