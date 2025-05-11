<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fin_journalhdr extends Model
{
    protected $table = 'fin_journalhdr';
	protected $fillable = [
        'cno_journal',
        'dtrans_date',
        'cdescription',
        'cno_evidence',
        'cperiod',
        'ntot_debet',
        'ntot_credit',
        'ctrans_type',
        'cstatus',
        'nposting',
        'posting_by',
        'posting_at',
        'cflag',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id'
    ];

}
