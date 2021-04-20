<?php

namespace App;
use App\SliderDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Slider extends Model
{
protected $table="slider";
public $timestamps = false;

     public function slider_description() {
     	if (session()->has('language_id')) {
         return $this->hasMany(SliderDescription::class , 'slider_id')->where('language_id','=',Session::get('language_id'));
        }
         return $this->hasMany(SliderDescription::class , 'slider_id')->where('language_id','=',1);
    }
}
