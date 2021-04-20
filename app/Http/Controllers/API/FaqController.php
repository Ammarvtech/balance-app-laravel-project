<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faq;
use App\Language;
use App\FaqDescription;
use Illuminate\Support\Facades\DB;
use Validator;


class FaqController extends Controller
{   
    public $successStatus = 200;
    ////////////All View \\\\\\\\\\\\\\\\
    public function index()
     {
        $faqs = DB::table('faq')
            ->select('faq.*','faq_description.*')
                ->join('faq_description','faq_description.faq_id','=','faq.id')
                ->get();
       $faqs = json_decode(json_encode($faqs));
       return response()->json(['success' =>true, "data"=> $faqs], $this-> successStatus);
     }
  
    //////////// View faqs By Languages\\\\\\\\\\\\\\\\
    public function allFaqs($language)
    {
        $lang_id=Language::where('name',$language)->pluck('language_id')->first();
        $faqs = DB::table('faq')
            ->select('faq.*','faq_description.*')
                ->join('faq_description','faq_description.faq_id','=','faq.id')
                ->where('language_id','=',$lang_id)
                ->get();
        $faqs = json_decode(json_encode($faqs));
        return response()->json(['success' =>true, "data"=> $faqs], $this-> successStatus);
    }

    //////////// View Faqs By Languages & Id \\\\\\\\\\\\\\\\
    public function show($id,$language)
    {
      $faq=Faq::find($id);
      if(is_null($faq)){
         return response()->json(["success"=>false, "message"=>"Record not Found"],404);
      }
        $lang_id=Language::where('name',$language)->pluck('language_id')->first();
        $faqs = DB::table('faq')
            ->select('faq.*','faq_description.*')
                ->join('faq_description','faq_description.faq_id','=','faq.id')
                ->where('language_id','=',$lang_id)
                ->where('id','=',$id)
                ->get();
        $faqs = json_decode(json_encode($faqs));
        return response()->json(['success' =>true, "data"=> $faqs], $this-> successStatus);
    }
    ////////////New creation \\\\\\\\\\\\\\\\
    public function store(Request $request )
    {
    if($request->isMethod('post')){
        $data = Validator::make($request->all(), [ 
          'question' => 'required', 
          'answer' => 'required', 
        ]);
        if ($data->fails()) { 
          return response()->json(['error'=>$data->errors()], 401);            
        }
          $data = $request->all();
        //  dd($data);
        $faq = new Faq; 
        $faq->sort_order = $data['sort_order'];
        $faq->save();
        $faq_id=Faq::orderBy('id', 'DESC')->pluck('id')->first();

        $data = $request->all();
        $finalArray = array();
          for($i=0; $i < count($data['language']);  $i++){
            $lang_id=Language::where('name',$data['language'][$i])->pluck('language_id')->first();
              array_push($finalArray, array(
                'faq_id'=> $faq_id,
                'language_id'=>$lang_id,
                'question'=>$data['question'][$i],
                'answer'=>$data['answer'][$i] )
              );
            }
            $result = FaqDescription::insert($finalArray);
            $faqs = DB::table('faq')
                ->select('faq.*','faq_description.*')
                ->join('faq_description','faq_description.faq_id','=','faq.id')
                ->where('id','=',$faq_id)
                ->get();
           $faqs = json_decode(json_encode($faqs));
           return response()->json(['success' =>true, "data"=>$faqs], $this-> successStatus);
        }
        return response(['message' => 'Error, check your details'], 400); 
    }
    


    ////////////Update data\\\\\\\\\\\\\\\\
    public function update(Request $request,$id){
       $category = Faq::find($id);
       //dd($request);
       if(is_null($category)){
           return response()->json(["success"=>false,"data"=>"","message"=>"Record not Found"],404);
       }
       $data = Validator::make($request->all(), [ 
         'question' => 'required', 
         'answer' => 'required', 
       ]);
       $data = $request->all();
       $sort_order = (!empty($data['sort_order'])) ? $data['sort_order'] : "";
       if($sort_order !=""){
         $test=Faq::where(['id'=>$id])->update(['sort_order'=>$data['sort_order']]);
       }
       $data = $request->all();
       //dd($data['language']);
       $count_items = count($data['language']);
       for($i = 0; $i<$count_items; $i++)
       {
        $lang_id = Language::where('name',$data['language'][$i])->pluck('language_id')->first();
        // dd($data['lang_id']);
        $prescription = FaqDescription::where('language_id',$lang_id)->where('faq_id',$id);
        $prescription->update([
           'question'=>$data['question'][$i],
           'answer'=>$data['answer'][$i],
        ]);
        }

        $faqs = DB::table('faq')
           ->select('faq.*','faq_description.*')
           ->join('faq_description','faq_description.faq_id','=','faq.id')
           ->where('id','=',$id)
           ->get();
        $faqs = json_decode(json_encode($faqs));
        return response()->json(['success' =>true, "data"=>$faqs], $this-> successStatus);
    }      
 
    ////////////Data Delete\\\\\\\\\\\\\\\
    public function destroy($id){
      $feature=Faq::find($id);
      if(is_null($feature)){
         return response()->json(["success"=>false, "message"=>"Record not Found"],404);
      }
      $feature->delete();
      return response()->json(["success"=>true,"message"=>"Record have been deleted Successfully"],204);
    }
}
