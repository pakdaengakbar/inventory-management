<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mregion extends Model
{
    //protected $table = 'mcompanies';
	protected $fillable   =
	[
        'ncompanie_id',
        'nprovinces_id',
        'ccode',
        'cname',
        'caddress1',
        'caddress2',
        'cphone',
        'cmobile',
        'cnofax',
        'ccity',
        'chead_branch',
        'chead_sales',
        'chead_service',
        'chead_part',
        'chead_finance',
        'cno_register',
        'csales1',
        'csales2',
        'csales3',
        'cstatus',
        'ccreate_by',
        'cupdate_by',
	];
}
