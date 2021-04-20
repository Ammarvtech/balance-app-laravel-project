<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderDescription extends Model
{
        protected $table="slider_description";
     public $timestamps = false;

     public function slider() {
         return $this->belongsTo(App\Slider::class);
     }

     public function language() {
         return $this->belongsTo(App\Language::class);
     }

}
