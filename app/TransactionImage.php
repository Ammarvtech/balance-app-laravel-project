<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionImage extends Model
{
	protected $table="transactionImages";
    	protected $fillable = [
		'user_id',
        'image',

	];
}
