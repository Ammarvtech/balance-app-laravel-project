<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageDescription extends Model
{
    protected $table="pages_description";
     public $timestamps = false;

    public function page() {
        return $this->belongsTo(App\Page::class);
    }

    public function language() {
        return $this->belongsTo(App\Language::class);
    }
}
