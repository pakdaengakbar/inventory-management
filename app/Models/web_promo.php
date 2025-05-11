<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_promo extends Model
{
    protected $table = 'web_promo';
    protected $fillable = [
        'cslugs',
        'ctitle',
        'csummary',
        'ccontents',
        'cstatus',
        'ctype',
        'ckeywords',
        'cimage',
        'cicon',
        'chits',
        'dpost_date',
        'dpublish_date',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
    ];
}
