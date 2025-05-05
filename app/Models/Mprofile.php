<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mprofile extends Model
{
    //protected $table = 'Mprofiles';
	protected $fillable   =
	[
	    'id',
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
