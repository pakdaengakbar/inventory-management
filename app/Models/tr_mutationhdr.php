<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\mregion as Region;
use App\Models\mexpedition as Expedition;

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
        'nsrc_region',
        'ndst_region',
        'nnum_log',
        'csender',
        'crecipient',
        'cterminal',
        'trs',
        'cflag',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id'
    ];
    public function expedition(): BelongsTo
    {
        return $this->belongsTo(Expedition::class, 'cexpedition');
    }
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'nregion_id');
    }
    public function src_region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'nsrc_region');
    }
    public function dst_region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'ndst_region');
    }
}
