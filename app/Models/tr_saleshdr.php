<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tr_saleshdr extends Model
{
    protected $table = 'tr_saleshdr';
    protected $fillable = [
        'cno_faktur',
        'corder_num',
        'csource',
        'cpay_type',
        'ncustomer_id',
        'ccusotmer_name',
        'dtrans_date',
        'cmonth',
        'ccashier',
        'ddue_date',
        'cnotes',
        'ck',
        'ndp',
        'ndisc',
        'nppn',
        'ntppn',
        'nsub_tot',
        'ntotal',
        'npayment',
        'nremaining',
        'csales_code',
        'csales_name',
        'cno_chip',
        'cSdName',
        'nperc_bonus',
        'ntotal_bonus',
        'cwarehouse',
        'nprint',
        'cterminal',
        'creceiv_limit',
        'nremain_receiv',
        'trs',
        'cstatus',
        'cno_delivery',
        'cwarranty',
        'nnumLog',
        'ndelete_flag',
        'ncompanie_id',
        'nregion_id',
        'ccreate_by',
        'cupdate_by',
    ];
}
