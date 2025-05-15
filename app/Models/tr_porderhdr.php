<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\msupplier as Supplier;
use App\Models\Mcompanie as Companie;
use App\Models\Mregion as Region;

class tr_porderhdr extends Model
{
    protected $table = 'tr_porderhdr';
    protected $fillable = [
        'id',
        'cno_quorder',
        'csupplier_id',
        'csupplier_name',
        'dtrans_date',
        'cppprove',
        'cppp_date',
        'cpay_type',
        'ccashier',
        'ntotal',
        'ddue_date',
        'cmonth',
        'Trs',
        'cnotes',
        'cstatus',
        'ncompanie_id',
        'nregion_id',
        'ccreate_by',
        'created_at',
        'cupdate_by',
        'updated_at',
        'cWarehouse',
        'nNumlog'
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
