<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{

	protected $table="temp_transactions";
    protected $fillable = [
    	'user_id',
    	'amount',
    	'date',
    	'type',
    	'note',
    	'beforeAmount',
    	'afterAmount',
    ];
}
