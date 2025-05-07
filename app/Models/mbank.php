<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mbank extends Model
{
    protected $fillable   =
	[
		'ccode',
		'cname',
        'ccreate_by',
        'cupdate_by',
	];
}
