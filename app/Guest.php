<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
	protected $primaryKey = 'ticket_no';
	protected $fillable = [
		'first_name',
		'last_name',
		'middle_name',
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
