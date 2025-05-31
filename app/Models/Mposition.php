<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mposition extends Model
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
