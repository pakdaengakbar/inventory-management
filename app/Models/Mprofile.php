<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mprofile extends Model
{

	protected $fillable   =
	[
        'cname',
        'cmotto',
        'caddress',
        'ccity',
        'cphone',
        'cfax',
        'cemail',
        'clogo',
        'ctitle',
        'ccreate_by',
        'cupdate_by',
        'cstatus'
	];
}
