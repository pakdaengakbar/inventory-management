<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Mregion as Region;

class tr_dorderhdr extends Model
{
     protected $table = 'tr_dorderhdr';
    protected $fillable = [
        'cno_delivery',
        'cno_faktur',
        'dtrans_date',
        'ctype',
        'ccashier',
        'ntotal',
        'nshipp_cost',
        'cexpedition',
        'cshipment',
        'cmonth',
        'cnotes',
        'cstatus',
        'cwarehouse',
        'cdestination',
        'nnum_log',
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

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'nregion_id');
    }
}
