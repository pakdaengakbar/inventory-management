<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fin_journaldtl extends Model
{
    protected $table = 'fin_journaldtl';
	protected $fillable = [
        'nheader_id',
        'cno_journal',
        'dtrans_date',
        'cacc_code',
        'cdescription',
        'cperiod',
        'ndebet',
        'ncredit',
        'cstatus',
        'nposting',
        'posting_by',
        'posting_at',
        'cFlag',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id'
    ];
}
