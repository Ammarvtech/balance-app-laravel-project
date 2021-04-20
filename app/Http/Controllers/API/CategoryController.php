<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\CategoryDescription;
use Illuminate\Support\Facades\DB;
use App\Language;

use Image;
use Auth;
use Session;

use Validator;
class CategoryController extends Controller
{
  
  public $successStatus = 200;
  ////All data\\\\\\\\\\\
  public function index()
  {
    $user_id=  Auth::user()->id;
    ///multi language work
    $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    ///end multi language work


    $language=(DB::table('users')->where('id',$user_id)->pluck('language')->first() ?? "English");
    $lang_id = (DB::table('language')->where('name',$language)->pluck('language_id')->first() ?? "1");
    $categoriesA = DB::table('category')
      ->select('category.*','category_description.*')
          ->join('category_description','category_description.category_id','=','category.id')
          ->where('language_id','=',$lang_id)
          ->where('user_id','=',"0")
          ->get()->toArray();
          //dd();
    //$finalArrayA=array($categoriesA);
    $categoriesB = DB::table('category')
      ->select('category.*','category_description.*')
          ->join('category_description','category_description.category_id','=','category.id')
          ->where('language_id','=',$lang_id)
          ->where('user_id','=',$user_id)
          ->get()->toArray();
   // $finalArrayB=array($categoriesB);
    $categories=array_merge($categoriesB,$categoriesA);
    $categories_detail=__('api.categories_detail');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$categories_detail, "data"=>$categories]);
    
  }

  ///Data by language\\\\\\
  public function allCategories($language)
  {

    ///multi language work
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    ///end multi language work

     $user_id=  Auth::user()->id;
     $lang_id=Language::where('name',$language)->pluck('language_id')->first();
     $categoriesA = DB::table('category')
       ->select('category.*','category_description.*')
           ->join('category_description','category_description.category_id','=','category.id')
           ->where('language_id','=',$lang_id)
           ->where('user_id','=',"0")
           ->get()->toArray();
           //dd();
     //$finalArrayA=array($categoriesA);
     $categoriesB = DB::table('category')
       ->select('category.*','category_description.*')
           ->join('category_description','category_description.category_id','=','category.id')
           ->where('language_id','=',$lang_id)
           ->where('user_id','=',$user_id)
           ->get()->toArray();
    // $finalArrayB=array($categoriesB);
     $categories=array_merge($categoriesB,$categoriesA);
     $categories = json_decode(json_encode($categories));

     $categories_detail=__('api.categories_detail');
     return response()->json(['status_code'=>200,'success' =>true,'message'=>$categories_detail, "data"=>$categories]);
  }



  ////////////View By Id \\\\\\\\\\\\\\\\
  public function show($id,$language)
  { 
    $lang_id=Language::where('name',$language)->pluck('language_id')->first();
    $categories = DB::table('category')
      ->select('category.*','category_description.*')
        ->join('category_description','category_description.category_id','=','category.id')
        ->where('language_id','=',$lang_id)
        ->where('id','=',$id)
        ->get();
    $categories = json_decode(json_encode($categories));
    return response()->json(['success' =>true, "data"=> $categories], $this-> successStatus);

  }




  ////////////New data creation\\\\\\\\\\\\\\\\
  public function store(Request $request )
  {

    ///multi language work
    $user =  Auth::user();
    $user_id = $user['id'];
    $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    ///end multi language work


    if($request->isMethod('post')){
    $data = Validator::make($request->all(), [ 
      'title' => 'required', 
    ]);
    if ($data->fails()) { 
      return response()->json(['error'=>$data->errors()], 401);            
    }
      $data = $request->all();
    //  dd($data);
    $category = new Category; 
    $category->sort_order = $data['sort_order'] ?? "0";
    $sliders=array();
    $user_id=  Auth::user()->id;
    $category->user_id = $user_id;

    $category->save();
    $category_id=Category::orderBy('id', 'DESC')->pluck('id')->first();

    $data = $request->all();
    $finalArray = array();
      // for($i=0; $i < count($data['language']);  $i++){  
        $language=(DB::table('users')->where('id',$user_id)->pluck('language')->first() ?? "English");
        $lang_id = (DB::table('language')->where('name',$language)->pluck('language_id')->first() ?? "1");
          array_push($finalArray, array(
            'category_id'=> $category_id,
            'language_id'=>$lang_id,
            'title'=>$data['title'],
            'description'=>$data['description'] ?? "empty")
          );
        // }
        $result = CategoryDescription::insert($finalArray);
        $categories = DB::table('category')
        ->select('category.*','category_description.*')
          ->join('category_description','category_description.category_id','=','category.id')
          ->where('id','=',$category_id)
          ->get();
      $categories = json_decode(json_encode($categories));
      $categories_success=__('api.categories_success');
      return response()->json(['status_code'=>200,'success' =>true,'message'=>$categories_success, "data"=>$categories]);
     }
    return response()->json(['status_code'=>400,'success' =>false,'message'=>"'Error, check your details"]);
  }


  ////////////Update data\\\\\\\\\\\\\\\\
  public function update(Request $request,$id){
    $category = Category::find($id);
    //dd($feature);
    if(is_null($category)){
        return response()->json(["success"=>false,"data"=>"","message"=>"Record not Found"],404);
    }
    $data = Validator::make($request->all(), [ 
      'title' => 'required', 
      'description' => 'required', 
    ]);
    $data = $request->all();
    $sort_order = (!empty($data['sort_order'])) ? $data['sort_order'] : "";
    if($sort_order !=""){
      $test=Category::where(['id'=>$id])->update(['sort_order'=>$data['sort_order']]);
    }
    $data = $request->all();
    //dd($data['language']);
    $count_items = count($data['language']);
    for($i = 0; $i<$count_items; $i++)
    {
      $lang_id = Language::where('name',$data['language'][$i])->pluck('language_id')->first();
     // dd($data['lang_id']);
      $prescription = CategoryDescription::where('language_id',$lang_id)->where('category_id',$id);
      $prescription->update([
        'title'=>$data['title'][$i],
        'description'=>$data['description'][$i] 
      ]);
    }

    $categories = DB::table('category')
      ->select('category.*','category_description.*')
       ->join('category_description','category_description.category_id','=','category.id')
       ->where('id','=',$id)
       ->get();


     ///multi language work
    $user =  Auth::user();
    $user_id = $user['id'];
    $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    ///end multi language work    
    $categories = json_decode(json_encode($categories));
    return response()->json(['success' =>true, "data"=>$categories], $this-> successStatus);
  }      
      



  public function destroy($id)
  {

    $category=Category::find($id);

    ///multi language work
    $user =  Auth::user();
    $user_id = $user['id'];
    $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    ///end multi language work

    if(is_null($category)){
        $category_del_error=__('api.category_del_error');
        return response()->json(['status_code'=>400,'success' =>false,'message'=>$category_del_error]);
    }
    $category->delete();

    $category_del_sucess=__('api.category_del_sucess');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$category_del_sucess]);      
  }
}
