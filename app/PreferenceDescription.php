<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreferenceDescription extends Model
{
    public $timestamps = false;
    protected $table="preferences_descriptions";

    public function preferences() {
        return $this->belongsTo(App\Preference::class);
    }

    public function language() {
        return $this->belongsTo(App\Language::class);
    }
}
