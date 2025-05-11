<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_news extends Model
{
    protected $table = 'web_news';
    protected $fillable = [
        'ccategory_id',
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
        'created_at',
        'updated_at'
    ];
}
