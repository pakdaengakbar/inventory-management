<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tr_qorderhdr extends Model
{
    protected $fillable = [
        'id',
        'cno_quorder',
        'csupplier_id',
        'csupplier_name',
        'dtrans_date',
        'cppprove',
        'cppp_date',
        'cpay_type',
        'ccashier',
        'ntotal',
        'ddue_date',
        'cmonth',
        'Trs',
        'cnotes',
        'cstatus',
        'ncompanie_id',
        'nregion_id',
        'ccreate_by',
        'created_at',
        'cupdate_by',
        'updated_at',
        'cWarehouse',
        'nNumlog'
    ];

}
