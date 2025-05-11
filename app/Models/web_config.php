<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class web_config extends Model
{
    protected $table = 'web_config';
    protected $fillable = [
        'cwebname',
        'cshortname',
        'ctagline',
        'cabout',
        'cdescription',
        'cwebsite',
        'cemail',
        'cemailoth',
        'caddress',
        'cphone',
        'cmobile',
        'clogo',
        'cicon',
        'ckeywords',
        'cmetatext',
        'cwhatsapp',
        'cfacebook',
        'cfacebook_Adsense',
        'ctwitter',
        'cinstagram',
        'cyoutube',
        'cfacebook_Name',
        'ctwitter_name',
        'cinstagram_name',
        'cyoutube_name',
        'cgoogle_map',
        'cgoogle_analytics',
        'cprotocol',
        'smtp_host',
        'smtp_port',
        'smtp_timeout',
        'smtp_user',
        'smtp_pass',
        'ccreate_by',
        'cupdate_by',
        'ncompanie_id',
        'nregion_id',
    ];

}
