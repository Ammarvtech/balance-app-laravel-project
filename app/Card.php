<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
    	'user_id',
    	'name',
    	'card_number',
    	'expiry_date',
    	'cvv',

    ];

}
