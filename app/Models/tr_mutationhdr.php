<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tr_mutationhdr extends Model
{
    protected $table = 'tr_mutationhdr';
    protected $fillable = [
        'cno_mutation',
        'cno_order',
        'dtrans_date',
        'ctype',
        'ccashier',
        'nsub_total',
        'nshipp_cost',
        'ntotal',
        'cexpedition',
        'cshipment',
        'cmonth',
        'cnotes',
        'cstatus',
        'cSourceWrh',
        'cdestination',
        'nnumlog',
        'csender',
        'crecipient',
        'Trs',
        'cterminal',
        'cflag',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id'
    ];

}
