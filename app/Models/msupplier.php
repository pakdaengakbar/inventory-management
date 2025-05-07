<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class msupplier extends Model
{
    protected $fillable   =
	[
		'cstatus',
        'ccode',
        'cname',
        'caddress',
        'ccity',
        'cphone',
        'caccount',
        'ccreate_by',
        'cupdate_by',
	];
}
