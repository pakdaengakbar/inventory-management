<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;
use App\Models\msupplier as supplier ;
use App\Models\mbrand_group;
use App\Models\User;

class mprodcafe extends Model
{
    protected $table = 'mprodcafe';
    protected $fillable = [
        'cbrand_code',
        'cgroup_code',
        'ctype_code',
        'ccurr_code',
        'nbarcode',
        'cuom_code',
        'citem_code',
        'citem_name',
        'cwsale_unit',
        'cretail_unit',
        'nwsale_value',
        'nretail_value',
        'nwsale_po_price',
        'nretail_po_price',
        'nwsale_sell_price',
        'nretail_sell_price',
        'dexpire_date',
        'clocation',
        'nstock_min',
        'nstock_max',
        'nopname_G1',
        'nopname_G2',
        'nopname_G3',
        'clocation1',
        'clocation2',
        'clocation3',
        'cdescription',
        'cmade_in',
        'COGS',
        'ccreate_by',
        'created_at',
        'cupdate_by',
        'updated_at',
        'csupplier_id',
        'cGroupStock',
        'cflag_pusat',
        'iPhoto',
        'cstatus',
        'ctimer',
    ];

    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'csupplier_id');
    }
    public function createby(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ccreate_by');
    }
    public function updateby(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cupdate_by');
    }
    public function itemgroup(): BelongsTo
    {
        return $this->belongsTo(mbrand_group::class, 'cgroup_code','ccode');

    }

}


