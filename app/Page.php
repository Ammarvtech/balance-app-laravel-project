<?php

namespace App;

use App\PageDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Page extends Model
{
	protected $table="page";
	public $timestamps = false;
	public function pages_description() {
		if (session()->has('language_id')) {
		   return $this->hasMany(PageDescription::class , 'page_id')->where('language_id','=',Session::get('language_id'));
		}
	return $this->hasMany(PageDescription::class , 'page_id')->where('language_id','=',1);
	}
}
