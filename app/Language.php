<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table="language";
    public $timestamps = false;

    public function preference_description() {
        return $this->hasMany(App\PreferenceDescription::class , 'language_id');
    }
    public function slider_description() {
        return $this->hasMany(App\SliderDescription::class , 'language_id');
    }
    public function feature_description() {
        return $this->hasMany(App\FeatureTranslation::class , 'language_id');
    }

        protected $fillable = [
        'name',
        'directory',
        'status',
        'font',
        'direction',
    ];
    
}
