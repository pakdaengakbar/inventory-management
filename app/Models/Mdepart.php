<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mdepart extends Model
{
   protected $fillable   =
	[
		'ncompanie_id',
		'ccode',
		'cname',
		'cstatus',
		'ccreate_by',
		'cupdate_by',
	];
}
