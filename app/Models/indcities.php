<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class indcities extends Model
{
    protected $table = 'indonesia_cities';
	protected $fillable   =
	[
		'code',
		'province_code',
		'name',
		'meta'
	];

    public function province()
    {
        return $this->belongsTo('App\Models\indprovince', 'province_code', 'code');
    }

}
