<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fin_acctype extends Model
{
    protected $fillable = [
        'ctype',
        'cdescription',
        'ccreate_by',
        'cupdate_by',
    ];
}
