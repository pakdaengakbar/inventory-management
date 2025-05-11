<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_video extends Model
{
    protected $table = 'web_video';
    protected $fillable = [
        'ctitle',
        'cslug',
        'cdescription',
        'cvidio',
        'cpost_date',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
    ];
}
