<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Mregion as Region;
use App\Models\mcustomer as Customer;
use App\Models\mexpedition as Expedition;

class tr_dorderhdr extends Model
{
    protected $table = 'tr_dorderhdr';
    protected $fillable = [
        'cno_delivery',
        'cno_faktur',
        'ncustomer_id',
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
    public function expedition(): BelongsTo
    {
        return $this->belongsTo(Expedition::class, 'cexpedition');
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'ncustomer_id');
    }
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'nregion_id');
    }
}
