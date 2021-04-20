<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public $timestamps = false;
   protected $table="category";
   
   public static function searchCategories($data){
        return DB::table('category')
            ->select('category.*','category_description.*')
            ->join('category_description','category_description.category_id','=','category.id')
                ->join('users','users.id','=','category.user_id')
                ->where('language_id','=',1)
                ->where('user_id','=',$data['user_id'])
                ->where('title', 'like', '%'.$data['title'].'%')
                ->get();
   }
}
