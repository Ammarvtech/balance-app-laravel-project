<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //protected $table="subacriptions";
    protected $fillable = [
    	'user_id',
    	'name',
    	'card_number',
    	'expiry_date',
    	'cvv',
    	'Subscription_type',
    ];
}
