<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	protected $fillable = [
		'ticket_no',
		'guest_id',
	];
}
