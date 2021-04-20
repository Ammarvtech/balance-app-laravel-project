<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestimonialDescription extends Model
{
    protected $table="testimonial_description";
     public $timestamps = false;

    public function testimonial() {
        return $this->belongsTo(App\Testimonial::class);
    }
}
