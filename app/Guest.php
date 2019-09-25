<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
	protected $fillable = [
		'first_name',
		'last_name',
		'middle_initial',
		'batch_year',
		'ticket_no',
		'honors',
		'profession',
		'company_org',
		'address',
		'residence',
		'telephone',
		'cellphone',
		'email',
		'degree',
		'raffle',
	];
}
