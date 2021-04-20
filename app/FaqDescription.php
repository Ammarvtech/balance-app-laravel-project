<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqDescription extends Model
{
    public $timestamps = false;
    protected $table="faq_description";

    public function faq() {
        return $this->belongsTo(App\Faq::class);
    }

}
