<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Image;
use App\Feature;
use App\FeatureTranslation;
use Illuminate\Support\Facades\DB;

use App\Language;
use Validator;

class FeatureController extends Controller
{
  public $successStatus = 200;

  ////All data\\\\\\\\\\\
  public function index()
  { 
    $features = DB::table('feature')
        ->select('feature.*','feature_description.*')
            ->join('feature_description','feature_description.feature_id','=','feature.id')
           
            ->get();
    $features = json_decode(json_encode($features));
    return response()->json(['success' =>true, "data"=> $features], $this-> successStatus);
  }



  ///Data by language\\\\\\
  public function AllFeatures($language)
  { 
    $lang_id=Language::where('name',$language)->pluck('language_id')->first();
    $features = DB::table('feature')
        ->select('feature.*','feature_description.*')
            ->join('feature_description','feature_description.feature_id','=','feature.id')
            ->where('language_id','=',$lang_id)
            ->get();
    $features = json_decode(json_encode($features));
    return response()->json(['success' =>true, "data"=> $features], $this-> successStatus);
  }


  ////////////View By Id \\\\\\\\\\\\\\\\
  public function featureById($id,$language)
  { 
    $lang_id=Language::where('name',$language)->pluck('language_id')->first();
    $features = DB::table('feature')
        ->select('feature.*','feature_description.*')
            ->join('feature_description','feature_description.feature_id','=','feature.id')
            ->where('language_id','=',$lang_id)
            ->where('id','=',$id)
            ->get();
    $features = json_decode(json_encode($features));
    return response()->json(['success' =>true, "data"=> $features], $this-> successStatus);
  }



 
  ////////////New data creation\\\\\\\\\\\\\\\\
  public function store(Request $request )
  {
    if($request->isMethod('post')){
		$data = Validator::make($request->all(), [ 
			'title' => 'required', 
			'description' => 'required', 
		]);
		if ($data->fails()) { 
			return response()->json(['error'=>$data->errors()], 401);            
		}
      $data = $request->all();
    //  dd($data);
    $feature = new Feature; 
    $feature->sort_order = $data['sort_order'];
    if($request->hasFile('image')){
      $image_tmp = $request->image; //Input::file('image');
      if($image_tmp->isValid()){
        $extension = $image_tmp->getClientOriginalExtension();
        $filename = rand(111,99999).'.'.$extension;
        $image_path = 'images/Features/'.$filename;
        // Resize Images
        Image::make($image_tmp)->save($image_path);
        //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
        //Image::make($image_tmp)->resize(300,300)->save($small_image_path);

        // Store image name in products table
        $feature->image = $filename;
      }
    }
    
    $feature->save();
    $feature_id=Feature::orderBy('id', 'DESC')->pluck('id')->first();

		$data = $request->all();
    $finalArray = array();
      for($i=0; $i < count($data['language']);  $i++){
        $lang_id=Language::where('name',$data['language'][$i])->pluck('language_id')->first();
          array_push($finalArray, array(
              'feature_id'=> $feature_id,
              'language_id'=>$lang_id,
              'title'=>$data['title'][$i],
              'description'=>$data['description'][$i] )
          );
      }
      $result = FeatureTranslation::insert($finalArray);
    $features = DB::table('feature')
        ->select('feature.*','feature_description.*')
            ->join('feature_description','feature_description.feature_id','=','feature.id')
    
            ->where('id','=',$feature_id)
            ->get();
    $features = json_decode(json_encode($features));
		return response()->json(['success' =>true, "data"=>$features], $this-> successStatus);
      }
      return response(['message' => 'Error, check your details'], 400);   
  }


  ////////////Update data\\\\\\\\\\\\\\\\
  public function update(Request $request,$id){
    $feature = Feature::find($id);
    //dd($feature);
    if(is_null($feature)){
        return response()->json(["success"=>false,"data"=>"","message"=>"Record not Found"],404);
    }
    $data = Validator::make($request->all(), [ 
      'title' => 'required', 
      'description' => 'required', 
    ]);
    $data = $request->all();
    $sort_order = (!empty($data['sort_order'])) ? $data['sort_order'] : "";
    if($sort_order !="")
      $test=Feature::where(['id'=>$id])->update(['sort_order'=>$data['sort_order']]);
    if($request->hasFile('image')){
      $image_tmp = $request->image; //Input::file('image');
      if($image_tmp->isValid()){
        $extension = $image_tmp->getClientOriginalExtension();
        $filename = rand(111,99999).'.'.$extension;
        $image_path = 'images/Features/'.$filename;
        // Resize Images
        Image::make($image_tmp)->save($image_path);
        Feature::where(['id'=>$id])->update([
        'image'=>$filename]);
      }
    }
    $data = $request->all();
    //dd($data['language']);
    $count_items = count($data['language']);
    for($i = 0; $i<$count_items; $i++)
    {
      $lang_id = Language::where('name',$data['language'][$i])->pluck('language_id')->first();
     // dd($data['lang_id']);
      $prescription = FeatureTranslation::where('language_id',$lang_id)->where('feature_id',$id);
      $prescription->update([
          'title'=>$data['title'][$i],
          'description'=>$data['description'][$i] 
      ]);
    }

   $feature->save();
   $features = DB::table('feature')
    ->select('feature.*','feature_description.*')
    ->join('feature_description','feature_description.feature_id','=','feature.id')

     ->where('id','=',$id)
     ->get();
   $features = json_decode(json_encode($features));
   return response()->json(["success" => true,"data"=>$features], $this-> successStatus);
  }      
  


  ////////////Data Delete\\\\\\\\\\\\\\\
  public function destroy(Request $request,$id){
    $feature=Feature::find($id);
    if(is_null($feature)){
       return response()->json(["success"=>false, "message"=>"Record not Found"],404);
    }
    $feature->delete();
    return response()->json(["success"=>true,"message"=>"Record have been deleted Successfully"],204);
  }
}
