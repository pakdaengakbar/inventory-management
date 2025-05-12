<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tr_salesdtl extends Model
{
    protected $table = 'tr_salesdtl';
    protected $fillable = [
        'nheader_id',
        'cno_faktur',
        'dtrans_date',
        'corder_num',
        'cpay_type',
        'cImei',
        'citem_code',
        'citem_name',
        'nbonus',
        'cuom',
        'nqty',
        'nhpp',
        'nprice',
        'cmonth',
        'time',
        'ccashier',
        'ndiscount',
        'ccust_code',
        'ccustomer',
        'kode',
        'store',
        'ck',
        'pls',
        'ddue_date',
        'cnotes',
        'cstatus_code',
        'cpulses_type',
        'csales_code',
        'nwholes_price',
        'ntype_price',
        'cchip_mum',
        'ntotal_bonus',
        'nperc_bonus',
        'nperc_bonus_temp',
        'cno_tujuan',
        'cproduk_code',
        'cekios_code',
        'cdataservice_profile',
        'cvia_transfer',
        'csource',
        'cagent_code',
        'trs',
        'nservices',
        'ctechnician_code',
        'nservice_price',
        'ncompanie_id',
        'nregion_id',
        'ccreate_by',
        'created_at',
        'cupdate_by',
        'updated_at',
        'cStartTime',
        'cEndTime',
        'cTimer'
    ];

}
