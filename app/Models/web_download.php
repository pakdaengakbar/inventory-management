<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_download extends Model
{
    protected $table = 'web_download';
    protected $fillable = [
        'ccategory_id',
        'ctitle',
        'ctype',
        'ccontent',
        'cimages',
        'cwebsite',
        'chits',
        'dpost_date',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
    ];
}
