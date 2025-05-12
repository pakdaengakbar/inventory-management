<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tr_dorderdtl extends Model
{
    protected $table = 'tr_dorderdtl';
    protected $fillable = [
        'id',
        'nheader_id',
        'dtrans_date',
        'cno_delivery',
        'cno_faktur',
        'ctype',
        'nbarcode',
        'citem_code',
        'citem_name',
        'nqty',
        'cuom',
        'nprice',
        'cmonth',
        'ctime',
        'cterminal',
        'Trs',
        'cstatus',
        'cwarehouse',
        'ccreate_by',
        'cupdate_by',
        'created_at',
        'updated_at',
        'ncompanie_id',
        'nregion_id'
    ];


}
