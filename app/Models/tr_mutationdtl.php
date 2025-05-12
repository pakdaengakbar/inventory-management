<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tr_mutationdtl extends Model
{
    protected $table = 'tr_mutationdtl';
    protected $fillable = [
        'nheader_id',
        'dtrans_date',
        'cno_mutation',
        'ctype',
        'cno_order',
        'nbarcode',
        'citem_code',
        'citem_name',
        'nqty',
        'cuom',
        'nwsale_po_price',
        'nretail_po_price',
        'nwsale_sell_price',
        'nretail_sell_price',
        'cmonth',
        'cTime',
        'cTerminal',
        'Trs',
        'cstatus',
        'cWarehouse',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id'
    ];

}
