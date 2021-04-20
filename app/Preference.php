<?php

namespace App;
use App\PreferenceDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Preference extends Model
{
    public $timestamps = false;
    protected $table="preferences";

    public function preference_description() {
    	if (session()->has('language_id')) {
        return $this->hasMany(PreferenceDescription::class , 'preference_id')->where('language_id','=',Session::get('language_id'));
	    }
	    return $this->hasMany(PreferenceDescription::class , 'preference_id')->where('language_id','=',1);
    }
}
