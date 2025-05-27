<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cafetable extends Model
{
    //mtable
    protected $table = 'mtables';
    protected $fillable   =
	[
		'ccode',
		'cname',
	];
}
