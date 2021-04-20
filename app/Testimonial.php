<?php

namespace App;
use App\TestimonialDescription;
use Illuminate\Support\Facades\Session;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
   protected $table="testimonial";
    public $timestamps = false;


	public function testimonial_description() {
		if (session()->has('language_id')) {
		return $this->hasMany(TestimonialDescription::class , 'testimonial_id')->where('language_id','=',Session::get('language_id'));
		}
		return $this->hasMany(TestimonialDescription::class , 'testimonial_id')->where('language_id','=',1);
	}
    
}
