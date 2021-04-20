<?php

namespace App;
use App\FeatureTranslation;

// 1. To specify package’s class you are using
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;


class Feature extends Model
{

    public $timestamps=false;
    // 2. To add translation methods
    use Translatable; 
   protected $table="feature";
    
    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['feature_id', 'language_id','title', 'description'];

    public function feature_description() {
    	if (session()->has('language_id')) {
        return $this->hasMany(FeatureTranslation::class , 'feature_id')->where('language_id','=',Session::get('language_id'));
        }
        return $this->hasMany(FeatureTranslation::class , 'feature_id')->where('language_id','=',1);
    }
    
}
