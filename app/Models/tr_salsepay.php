<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tr_salsepay extends Model
{
    protected $table = 'tr_salsepay';
    protected $fillable = [
        'cno_faktur',
        'cno_faktur',
        'dtrans_date',
        'cpay_type',
        'ccard_num',
        'ccard_bank',
        'ccard_name',
        'ntot_trans',
        'npayment',
        'nremain',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id'
    ];
}


