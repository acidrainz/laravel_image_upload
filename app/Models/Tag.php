<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
	protected $guarded = [
		'id',
	];

	public function images(){
	    return $this->belongsTo('App\Models\Image');
	}
}
