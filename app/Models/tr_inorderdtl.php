<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tr_inorderdtl extends Model
{
    protected $table = 'tr_inorderdtl';
    protected $fillable = [
        'nheader_id',
        'dtrans_date',
        'csupplier_id',
        'cno_inorder',
        'nbarcode',
        'citem_code',
        'citem_name',
        'nqty',
        'nqty1',
        'cuom',
        'nhpp',
        'nprice',
        'cmonth',
        'ctime',
        'cpay_type',
        'cstatus',
        'cflag',
        'cwarehouse',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id'
    ];

}
