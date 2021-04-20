<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureTranslation extends Model
{
   protected $fillable = ['feature_id', 'language_id','title', 'description'];
   public $timestamps = false;
   protected $table="feature_description";

   public function language() {
       return $this->belongsTo(App\Language::class);
   }
   public function feature() {
       return $this->belongsTo(App\Feature::class);
   }

}
