<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_gallery extends Model
{
    protected $table = 'web_gallery';
    protected $fillable = [
        'ccategory_id',
        'ctitle',
        'ctype',
        'ccontent',
        'cimage',
        'cicon',
        'cwebsite',
        'cgroup',
        'chits',
        'cstatus',
        'dpost_date',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
    ];
}
