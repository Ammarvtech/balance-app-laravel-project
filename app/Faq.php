<?php

namespace App;
use App\FaqDescription;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public $timestamps = false;
    protected $table="faq";

    public function faq_description() {
    	if (session()->has('language_id')) {
    	return $this->hasMany(FaqDescription::class , 'faq_id')->where('language_id','=',Session::get('language_id'));
    	}
    	return $this->hasMany(FaqDescription::class , 'faq_id')->where('language_id','=',1);
    }
}
