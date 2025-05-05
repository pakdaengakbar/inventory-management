<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class indprovince extends Model
{
    protected $table = 'indonesia_provinces';
	protected $fillable   =
	[
		'code',
		'name',
		'meta'
	];
}
