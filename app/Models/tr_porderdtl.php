<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tr_porderdtl extends Model
{
    protected $table = 'tr_qorderdtl';
    protected $fillable = [
        'nheader_id',
        'cno_inorder',
        'dtrans_date',
        'csupplier_id',
        'nbarcode',
        'citem_code',
        'citem_name',
        'nqty',
        'nqty1',
        'cuom',
        'nhpp',
        'nprice',
        'cmonth',
        'cTime',
        'cpay_type',
        'cstatus',
        'cflag',
        'ncompanie_id',
        'nregion_id',
        'ccreate_by',
        'created_at',
        'cupdate_by',
        'updated_at',
        'cWarehouse',
    ];

}
