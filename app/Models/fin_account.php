<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fin_account extends Model
{
    protected $fillable = [
        'cacc_top',
        'cacc_header',
        'cacc_code',
        'cdescription',
        'clevel',
        'cstatus',
        'ctype',
        'csubtype',
        'nbalance',
        'cdelete_by',
        'delete_at',
        'ncompanie_id',
        'cregion_id',
        'ccreate_by',
        'cupdate_by',
    ];
}
