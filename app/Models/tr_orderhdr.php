<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\msupplier as Supplier;
use App\Models\Mcompanie as Companie;
use App\Models\Mregion as Region;

class tr_orderhdr extends Model
{
    protected $table = 'tr_orderhdr';
    protected $fillable = [
        'id',
        'cno_po',
        'cno_order',
        'corder_type',
        'csupplier_id',
        'csupplier_name',
        'csupplier_inv',
        'dtrans_date',
        'cpay_type',
        'capprove',
        'capp_date',
        'ccashier',
        'nppn',
        'ntot_ppn',
        'nsub_tot',
        'ntotal',
        'ddue_date',
        'cmonth',
        'cterminal',
        'cwarehouse',
        'cnotes',
        'cstatus',
        'nnum_log',
        'iphoto',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
        'delete_flag'
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'csupplier_id');
    }
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'nregion_id');
    }
    public function companie(): BelongsTo
    {
        return $this->belongsTo(Companie::class, 'ncompanie_id');
    }
}
