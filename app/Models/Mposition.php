<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mposition extends Model
{
    protected $primaryKey = 'ccode';
	protected $fillable   =
	[
		'ccode',
        'cname',
        'clocation',
        'ccreate_by',
        'cupdate_by',
    ];

}
