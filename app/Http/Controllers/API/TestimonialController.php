<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Testimonial;
use App\TestimonialDescription;
use Illuminate\Support\Facades\DB;
use App\Language;
use Validator;
use Image;
class TestimonialController extends Controller
{
  public $successStatus = 200;
  ////////////All View \\\\\\\\\\\\\\\\
  public function index()
  {
    $testimonials = DB::table('testimonial')
     ->select('testimonial.*','testimonial_description.*')
     ->join('testimonial_description','testimonial_description.testimonial_id','=','testimonial.id')
     ->get();
    $testimonials = json_decode(json_encode($testimonials));
  return response()->json(['success' =>true, "data"=> $testimonials], $this-> successStatus);
  }
  
  //////////// View faqs By Languages\\\\\\\\\\\\\\\\
  public function allTestimonials($language)
  {
    $lang_id=Language::where('name',$language)->pluck('language_id')->first();
    $testimonials = DB::table('testimonial')
      ->select('testimonial.*','testimonial_description.*')
      ->join('testimonial_description','testimonial_description.testimonial_id','=','testimonial.id')
      ->where('language_id','=',$lang_id)
      ->get();
    $testimonials = json_decode(json_encode($testimonials));
    return response()->json(['success' =>true, "data"=> $testimonials], $this-> successStatus);
  }

  //////////// View Faqs By Languages & Id \\\\\\\\\\\\\\\\
  public function show($id,$language)
  {
    $lang_id=Language::where('name',$language)->pluck('language_id')->first();
      $testimonials = DB::table('testimonial')
       ->select('testimonial.*','testimonial_description.*')
       ->join('testimonial_description','testimonial_description.testimonial_id','=','testimonial.id')
       ->where('language_id','=',$lang_id)
       ->where('id','=',$id)
       ->get();
      $testimonials = json_decode(json_encode($testimonials));
    return response()->json(['success' =>true, "data"=> $testimonials], $this-> successStatus);
  }
  ////////////New creation \\\\\\\\\\\\\\\\
  public function store(Request $request )
  {
  if($request->isMethod('post')){
      $data = Validator::make($request->all(), [ 
        'testimonial_name' => 'required', 
        'designation' => 'required', 
        'description' => 'required', 
      ]);
      if ($data->fails()) { 
        return response()->json(['error'=>$data->errors()], 401);            
      }
        $data = $request->all();
      //  dd($data);
      $testimonial = new Testimonial; 
      $testimonial->sort_order = $data['sort_order'];
      if($request->hasFile('image')){
        $image_tmp = $request->image; //Input::file('image');
        if($image_tmp->isValid()){
          $extension = $image_tmp->getClientOriginalExtension();
          $filename = rand(111,99999).'.'.$extension;
          $image_path = 'images/testimonials/'.$filename;
          // Resize Images
          Image::make($image_tmp)->save($image_path);
          //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
          //Image::make($image_tmp)->resize(300,300)->save($small_image_path);

          // Store image name in products table
          $testimonial->image = $filename;
        }
      }
      $testimonial->save();
      $testimonial_id=Testimonial::orderBy('id', 'DESC')->pluck('id')->first();

      $data = $request->all();
      $finalArray = array();
        for($i=0; $i < count($data['language']);  $i++){
          $lang_id=Language::where('name',$data['language'][$i])->pluck('language_id')->first();
            array_push($finalArray, array(
              'testimonial_id'=> $testimonial_id,
              'language_id'=>$lang_id,
              'testimonial_name'=>$data['testimonial_name'][$i],
              'designation'=>$data['designation'][$i],
              'description'=>$data['description'][$i] )
            );
          }
          $result = TestimonialDescription::insert($finalArray);
          $testimonials = DB::table('testimonial')
            ->select('testimonial.*','testimonial_description.*')
            ->join('testimonial_description','testimonial_description.testimonial_id','=','testimonial.id')
            ->where('id','=',$testimonial_id)
            ->get();
          $testimonials = json_decode(json_encode($testimonials));
        return response()->json(['success' =>true, "data"=>$testimonials], $this-> successStatus);
      }
      return response(['message' => 'Error, check your details'], 400); 
  }
  


  ////////////Update data\\\\\\\\\\\\\\\\
  public function update(Request $request,$id){
    $category = Testimonial::find($id);
    //dd($request);
    if(is_null($category)){
       return response()->json(["success"=>false,"data"=>"","message"=>"Record not Found"],404);
    }
    $data = Validator::make($request->all(), [ 
    'testimonial_name' => 'required', 
    'designation' => 'required', 
    'description' => 'required', 
    ]);
    $data = $request->all();
    $sort_order = (!empty($data['sort_order'])) ? $data['sort_order'] : "";
    if($sort_order !=""){
     $test=Testimonial::where(['id'=>$id])->update(['sort_order'=>$data['sort_order']]);
    }
    if($request->hasFile('image')){
      $image_tmp = $request->image; //Input::file('image');
      if($image_tmp->isValid()){
        $extension = $image_tmp->getClientOriginalExtension();
        $filename = rand(111,99999).'.'.$extension;
        $image_path = 'images/testimonials/'.$filename;
        // Resize Images
        Image::make($image_tmp)->save($image_path);
        Testimonial::where(['id'=>$id])->update([
        'image'=>$filename]);
      }
    }
   $data = $request->all();
   $count_items = count($data['language']);
   for($i = 0; $i<$count_items; $i++)
   {
    $lang_id = Language::where('name',$data['language'][$i])->pluck('language_id')->first();
    // dd($data['lang_id']);
    $prescription = TestimonialDescription::where('language_id',$lang_id)->where('testimonial_id',$id);
    $prescription->update([
       'testimonial_name'=>$data['testimonial_name'][$i],
       'designation'=>$data['designation'][$i],
       'description'=>$data['description'][$i],
    ]);
    }

    $testimonials = DB::table('testimonial')
      ->select('testimonial.*','testimonial_description.*')
      ->join('testimonial_description','testimonial_description.testimonial_id','=','testimonial.id')
      ->where('id','=',$id)
      ->get();
    $testimonials = json_decode(json_encode($testimonials));
    return response()->json(['success' =>true, "data"=>$testimonials], $this-> successStatus);
  }       
  
  
  ////////////Data Delete\\\\\\\\\\\\\\\
  public function destroy($id){
    $testimonial=Testimonial::find($id);
    if(is_null($testimonial)){
       return response()->json(["success"=>false, "message"=>"Record not Found"],404);
    }
    $testimonial->delete();
    return response()->json(["success"=>true],$this-> successStatus);
  }
}
