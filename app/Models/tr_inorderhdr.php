<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tr_inorderhdr extends Model
{
    protected $fillable = [
        'cno_inorder',
        'csupplier_id',
        'csupplier_name',
        'dtrans_date',
        'capprove',
        'capp_date',
        'cpay_type',
        'ccashier',
        'ntotal',
        'ddue_date',
        'cmonth',
        'Trs',
        'cnotes',
        'cstatus',
        'cwarehouse',
        'nnum_log',
        'ccreate_by',
        'cupdate_by',
        'created_at',
        'updated_at',
        'ncompanie_id',
        'nregion_id'
    ];

}
