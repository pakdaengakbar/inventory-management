<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_users extends Model
{
    protected $table = 'web_users';
    protected $fillable = [
        'cfull_name',
        'cuser_name',
        'cpassword',
        'cemail',
        'clevel',
        'csecretcode',
        'cimage',
        'cnotes',
        'dlast_login',
        'cip_static',
        'cuser_log',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
    ];
}
