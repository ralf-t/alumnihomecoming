<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
	protected $fillable = [
		'first_name',
		'last_name',
		'school_year',
	];
}
