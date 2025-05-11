<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fin_balance extends Model
{
   protected $fillable = [
        'cyear',
        'cperiod',
        'cacc_code',
        'cdebet',
        'ccredit',
        'dinster_date',
        'cstatus',
        'ncompanie_id',
        'nregion_id',
        'ccreate_by',
        'cupdate_by',
    ];
}
