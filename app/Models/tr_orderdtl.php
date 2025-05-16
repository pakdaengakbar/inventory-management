<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\msupplier as Supplier;
use App\Models\Mcompanie as Companie;
use App\Models\Mregion as Region;

class tr_orderdtl extends Model
{
    protected $table = 'tr_orderdtl';
    protected $fillable = [
        'id',
        'nheader_id',
        'dtrans_date',
        'cno_po',
        'cno_order',
        'csupplier_id',
        'nbarcode',
        'citem_code',
        'citem_name',
        'cuom',
        'nqty',
        'nqty2',
        'nwsale_po_price',
        'nretail_po_price',
        'cmonth',
        'cpot',
        'cpay_type',
        'ddue_date',
        'ctarehouse',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
        'delete_flg'
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
