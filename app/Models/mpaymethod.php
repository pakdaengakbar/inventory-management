<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mpaymethod extends Model
{
    protected $fillable   =
	[
		'cmethod',
        'cstatus'
    ];
}
