<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class msupplier extends Model
{
    protected $fillable   =
	[
	    'ccode',
        'cname',
        'caddress',
        'ccity',
        'cphone',
        'cemail',
        'caccount',
        'cstatus',
        'ccreate_by',
        'cupdate_by',
	];
}
