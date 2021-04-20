<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\AppSLiderDescription;

use Illuminate\Support\Facades\DB;

use App\Language;
use App\User;

use Image;
use Illuminate\Support\Facades\Auth;

use App\AppSLider;

use Validator;

class AppSliderController extends Controller
{
    public $successStatus = 200;

    ////////////All View \\\\\\\\\\\\\\\\

    public function index()

    {
    	$sliders=array();
      $user_id=  Auth::user()->id;
     
      $language=(DB::table('users')->where('id',$user_id)->pluck('language')->first() ?? "English");
      $lang_id = (DB::table('language')->where('name',$language)->pluck('language_id')->first() ?? "1");
       $sliders = DB::table('app_slider')
        ->select('app_slider.*','app_slider_description.*')

        ->join('app_slider_description','app_slider_description.app_slider_id','=','app_slider.id')
        ->where('language_id','=',$lang_id)
        ->get();

        $sliders[] = json_decode(json_encode($sliders));
        return response()->json(['status_code'=>200,'success' =>true,'message'=>"Slider's detail", "data"=>$sliders]);

    }

    

    //////////// View faqs By Languages\\\\\\\\\\\\\\\\

    public function allSliders($language)

    {
        $data = array();
        $data['path'] = env('APP_URL').'images/slider/';
        $lang_id=Language::where('name',$language)->pluck('language_id')->first();
        ///local session\\\
        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
        Session::put('locale', $directory);       
        \App::setLocale(Session::get('locale'));
        ///end local session\\\
        $app = DB::table('app_slider')

            ->select('app_slider.*','app_slider_description.*')

            ->join('app_slider_description','app_slider_description.app_slider_id','=','app_slider.id')

            ->where('language_id','=',$lang_id)

            ->get();

        if($app == null){
          $slider_empty= __('api.slider_empty');
          return response()->json(['status_code'=>400,'success' =>false,'message'=>$slider_empty]);            
        }

        $data['sliders'] = json_decode(json_encode($app));
        $slider_empty= __('api.slider_empty');
         return response()->json(['status_code'=>200,'success' =>true,'message'=>$slider_empty, "data"=>$data]);


    }



    //////////// View Faqs By Languages & Id \\\\\\\\\\\\\\\\

    public function show($id,$language)

    {

      $slider=AppSLider::find($id);

      if(is_null($slider)){
         return response()->json(['status_code'=>400,'success' =>false,'message'=>"Record not found!"]);
      }

        $lang_id=Language::where('name',$language)->pluck('language_id')->first();

        $sliders = DB::table('app_slider')

            ->select('app_slider.*','app_slider_description.*')

            ->join('app_slider_description','app_slider_description.app_slider_id','=','app_slider.id')

            ->where('language_id','=',$lang_id)

            ->where('id','=',$id)

            ->get();

        $sliders = json_decode(json_encode($sliders));

        return response()->json(['status_code'=>200,'success' =>true,'message'=>"Slider's detail", "data"=>$sliders]);


    }

    ////////////New creation \\\\\\\\\\\\\\\\

    public function store(Request $request )

    {

    if($request->isMethod('post')){

        $validator = Validator::make($request->all(), [ 

            "title"    => "required",

            "description"    => "required",

            "button_text"    => "required",

            "sort_order"  => "required",

            "image"  => "required",

        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            $message = "";

            foreach ($errors->toArray() as $key => $value) {

                 $message.= $value[0]."\n";

             }

            $message = rtrim($message, "\n");         

            return response()->json(['status_code'=>400,'success' =>false,'message'=>$message]);            

        }

          $data = $request->all();

        //  dd($data);

        $sliders = new AppSLider; 

        $sliders->sort_order = $data['sort_order'];

        if($request->hasFile('image')){

          $image_tmp = $request->image; //Input::file('image');

          if($image_tmp->isValid()){

            $extension = $image_tmp->getClientOriginalExtension();

            $filename = rand(111,99999).'.'.$extension;

            $image_path ='images/slider/'.$filename;

            Image::make($image_tmp)->save($image_path);

            $sliders->image = $filename;

          }

        }


        $sliders->save();

        $slider_id=AppSLider::orderBy('id', 'DESC')->pluck('id')->first();



        $data = $request->all();

        $finalArray = array();

          for($i=0; $i < count($data['language']);  $i++){

            $lang_id=Language::where('name',$data['language'][$i])->pluck('language_id')->first();

              array_push($finalArray, array(

                'app_slider_id'=> $slider_id,

                'language_id'=>$lang_id,

                'title'=>$data['title'][$i],

                'description'=>$data['description'][$i],

                'button_text'=>$data['button_text'][$i] )

              );

            }

            $result = AppSLiderDescription::insert($finalArray);

            $sliders = DB::table('app_slider')

                ->select('app_slider.*','app_slider_description.*')

                ->join('app_slider_description','app_slider_description.app_slider_id','=','app_slider.id')

                ->where('id','=',$slider_id)

                ->get();

            $sliders = json_decode(json_encode($sliders));

            return response()->json(['status_code'=>200,'success' =>true,'message'=>"Slider's detail", "data"=>$sliders]);



        }

        return response(['message' => 'Error, check your details'], 400); 




    }

    





    ////////////Update data\\\\\\\\\\\\\\\\

    public function update(Request $request,$id){

        $category = AppSLider::find($id);

        //dd($request);

        if(is_null($category)){

         return response()->json(['status_code'=>400,'success' =>false,'message'=>"Record not found!"]);

        }

        $data = Validator::make($request->all(), [ 

       'title' => 'required', 

       'button_text' => 'required', 

       'description' => 'required', 

        ]);

        $data = $request->all();

        $sort_order = (!empty($data['sort_order'])) ? $data['sort_order'] : "";

        if($sort_order !=""){

           $test=AppSLider::where(['id'=>$id])->update(['sort_order'=>$data['sort_order']]);

        }

        if($request->hasFile('image')){

            $image_tmp = $request->image; //Input::file('image');

            if($image_tmp->isValid()){

              $extension = $image_tmp->getClientOriginalExtension();

              $filename = rand(111,99999).'.'.$extension;

              $image_path = 'images/slider/'.$filename;

              Image::make($image_tmp)->save($image_path);

             // $sliders->image = $filename;
              $test=AppSLider::where(['id'=>$id])->update(['image'=>$filename]);


            }

       }



       $data = $request->all();

       $count_items = count($data['language']);

       for($i = 0; $i<$count_items; $i++)

        {

            $lang_id = Language::where('name',$data['language'][$i])->pluck('language_id')->first();

              // dd($data['lang_id']);

            $prescription = AppSLiderDescription::where('language_id',$lang_id)->where('app_slider_id',$id);

            $prescription->update([

                'title'=>$data['title'][$i],

                'button_text'=>$data['button_text'][$i],

                'description'=>$data['description'][$i],

            ]);

       }



        $sliders = DB::table('app_slider')

          ->select('app_slider.*','app_slider_description.*')

          ->join('app_slider_description','app_slider_description.app_slider_id','=','app_slider.id')

          ->where('id','=',$id)

          ->get();

      $sliders = json_decode(json_encode($sliders));
      return response()->json(['status_code'=>200,'success' =>true,'message'=>"Slider's detail", "data"=>$sliders]);


    }       

    

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $slider=AppSLider::find($id);

        if(is_null($slider)){
           return response()->json(['status_code'=>400,'success' =>false,'message'=>"Record not found!"]);

        }

        $slider->delete();

        return response()->json(['status_code'=>200,'success' =>true,'message'=>"Record have been deleted Successfully"]);


    }
}
