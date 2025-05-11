<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_category extends Model
{
    protected $table = 'web_category';
    protected $fillable = [
        'cslug',
        'cname',
        'corder',
        'chits',
        'ctype',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
    ];

}
