<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mcolor extends Model
{
    protected $fillable   =
	[
		'ccode',
		'cname',
        'cnotes',
        'cphoto',
        'cflag',
        'ccreate_by',
        'cupdate_by',
	];
}
