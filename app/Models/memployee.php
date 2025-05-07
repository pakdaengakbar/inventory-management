<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class memployee extends Model
{
    protected $fillable = [
        'id',
        'ndept_id',
        'cemployee_num',
        'caccount_num',
        'cname',
        'caddress1',
        'caddress2',
        'ccity',
        'csex',
        'cphone',
        'cmobile',
        'cemail',
        'nuser_id',
        'cstatus',
        'cpost_code',
        'cposition',
        'cbank_account',
        'cbank_name',
        'dhire_date',
        'dborn_date',
        'cplace_of_date',
        'cnpwp',
        'iphoto',
        'cmarital',
        'ndependants',
        'PTKP',
        'creligion',
        'ceducation',
        'dentry_date',
        'ccreate_by',
        'cupdate_by',
        'created_at',
        'updated_at',
        'ncompanie_id',
        'nregion_id',
    ];
}
