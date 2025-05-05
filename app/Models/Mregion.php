<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mregion extends Model
{
    //protected $table = 'mcompanies';
	protected $fillable   =
	[
		'id',
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
        'cdealer_code',
        'cservice',
        'csales1',
        'csales2',
        'csales3',
        'cstatus',
        'ccreate_by',
        'cupdate_by',
	];
}
