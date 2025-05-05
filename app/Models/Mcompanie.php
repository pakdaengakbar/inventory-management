<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcompanie extends Model
{
    use HasFactory;

    //protected $table = 'mcompanies';
	protected $fillable   =
	[
		'id',
        'ccode',
        'cname',
        'ctitle',
        'caddress1',
        'caddress2',
        'ccity',
        'ccontact',
        'cphone1',
        'cphone2',
        'cfax1',
        'cfax2',
        'cemail',
        'cnpwp',
        'ctaxaddress',
        'cfaxregno',
        'cpresident',
        'caccountdir',
        'ctechnicdir',
        'cMarketDir',
        'clabel',
        'clogo',
        'cdefault',
        'cmemo',
        'cbank',
        'cnorek',
        'cTaxdir',
        'cregcode',
        'ccoacode',
        'ccreate_by',
        'cupdate_by',
	];
}
