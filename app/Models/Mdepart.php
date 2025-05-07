<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mdepart extends Model
{
   protected $fillable   =
	[
		'id',
		'ncompanie_id',
		'ccode',
		'cname',
		'cstatus',
		'ccreate_by',
		'cupdate_by',
	];
}
