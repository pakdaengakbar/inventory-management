<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mexpedition extends Model
{
    protected $fillable   =
	[
		'ccode',
		'cname',
        'cnote',
        'cflag',
        'ccreate_by',
        'cupdate_by',
	];
}
