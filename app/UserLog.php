<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table="user_log";
    protected $fillable = ['user_id','accessCode','userSecret', 'connectionID','accessToken', 'bank_name','bank_icon','type'];
    public $timestamps=false;

}
