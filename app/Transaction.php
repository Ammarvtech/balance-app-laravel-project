<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $fillable = [
		'user_id',
		'category',
		'amount',
		'transaction_type',
		'date',
		'type',
		'note',
		'beforeAmount',
		'afterAmount',
	];
}
