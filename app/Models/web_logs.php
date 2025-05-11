<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_logs extends Model
{
    protected $table = 'web_logs';
    protected $fillable = [
        'ip_address',
        'curl',
        'cimage',
        'cnotes',
        'cpostdate',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
    ];
}
