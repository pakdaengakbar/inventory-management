<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\mregion as Region;

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
        'nprice',
        'cmonth',
        'ctime',
        'cterminal',
        'trs',
        'cstatus',
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
