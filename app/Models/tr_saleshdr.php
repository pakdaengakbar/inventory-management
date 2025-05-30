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
        'ccustomer_name',
        'dtrans_date',
        'cmonth',
        'ccashier',
        'ddue_date',
        'cnotes',
        'ck',
        'ndp',
        'ndisc',
        'ntot_disc',
        'nppn',
        'ntot_ppn',
        'nfee',
        'ntot_fee',
        'nsub_total',
        'ntotal',
        'npayment',
        'nremaining',
        'csales_code',
        'csales_name',
        'cno_chip',
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
        'nnum_log',
        'ndelete_flag',
        'ncompanie_id',
        'nregion_id',
        'ccreate_by',
        'cupdate_by',
        'cflag'
    ];
}
