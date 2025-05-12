<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\msupplier as Supplier;

class tr_inorderhdr extends Model
{
    use HasFactory;
    protected $table = 'tr_inorderhdr';
    protected $fillable = [
        'cno_inorder',
        'csupplier_id',
        'csupplier_name',
        'dtrans_date',
        'capprove',
        'capp_date',
        'cpay_type',
        'ccashier',
        'ntotal',
        'ddue_date',
        'cmonth',
        'Trs',
        'cnotes',
        'cstatus',
        'cwarehouse',
        'nnum_log',
        'ccreate_by',
        'cupdate_by',
        'created_at',
        'updated_at',
        'ncompanie_id',
        'nregion_id'
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'csupplier_id');
    }
}
