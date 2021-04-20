 <?php



namespace App\Http\Controllers\API;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\SliderDescription;

use Illuminate\Support\Facades\DB;

use App\Language;

use Image;

use App\Slider;

use Validator;



class SliderController extends Controller

{

    public $successStatus = 200;

    ////////////All View \\\\\\\\\\\\\\\\

    public function index()

    {

      $sliders = DB::table('slider')

        ->select('slider.*','slider_description.*')

        ->join('slider_description','slider_description.slider_id','=','slider.id')

        ->get();

        $sliders = json_decode(json_encode($sliders));

    return response()->json(['success' =>true, "data"=> $sliders], $this-> successStatus);

    }

    

    //////////// View faqs By Languages\\\\\\\\\\\\\\\\

    public function allSliders($language)

    {

        $lang_id=Language::where('name',$language)->pluck('language_id')->first();

        $sliders = DB::table('slider')

            ->select('slider.*','slider_description.*')

            ->join('slider_description','slider_description.slider_id','=','slider.id')

            ->where('language_id','=',$lang_id)

            ->get();

        $sliders = json_decode(json_encode($sliders));

         return response()->json(['success' =>true, "data"=> $sliders], $this-> successStatus);

    }



    //////////// View Faqs By Languages & Id \\\\\\\\\\\\\\\\

    public function show($id,$language)

    {

      $slider=Slider::find($id);

      if(is_null($slider)){

         return response()->json(["success"=>false, "message"=>"Record not Found"],404);

      }

        $lang_id=Language::where('name',$language)->pluck('language_id')->first();

        $sliders = DB::table('slider')

            ->select('slider.*','slider_description.*')

            ->join('slider_description','slider_description.slider_id','=','slider.id')

            ->where('language_id','=',$lang_id)

            ->where('id','=',$id)

            ->get();

        $sliders = json_decode(json_encode($sliders));

        return response()->json(['success' =>true, "data"=> $sliders], $this-> successStatus);

    }

    ////////////New creation \\\\\\\\\\\\\\\\

    public function store(Request $request )

    {

    if($request->isMethod('post')){

        $data = Validator::make($request->all(), [ 

            "title"    => "required",

            "description"    => "required",

            "button_text"    => "required",

            "sort_order"  => "required",

            "image"  => "required",

            "baner"  => "required", 

        ]);

        if ($data->fails()) { 

          return response()->json(['error'=>$data->errors()], 401);            

        }

          $data = $request->all();

        //  dd($data);

        $sliders = new Slider; 

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

        if($request->hasFile('baner')){

          $image_tmp = $request->baner; //Input::file('image');

          if($image_tmp->isValid()){

            $extension = $image_tmp->getClientOriginalExtension();

            $filename = rand(111,99999).'.'.$extension;

            $image_path = 'images/slider/'.$filename;

            Image::make($image_tmp)->save($image_path);

            $sliders->baner = $filename;

          }

        }

        $sliders->save();

        $slider_id=Slider::orderBy('id', 'DESC')->pluck('id')->first();



        $data = $request->all();

        $finalArray = array();

          for($i=0; $i < count($data['language']);  $i++){

            $lang_id=Language::where('name',$data['language'][$i])->pluck('language_id')->first();

              array_push($finalArray, array(

                'slider_id'=> $slider_id,

                'language_id'=>$lang_id,

                'title'=>$data['title'][$i],

                'description'=>$data['description'][$i],

                'button_text'=>$data['button_text'][$i] )

              );

            }

            $result = SliderDescription::insert($finalArray);

            $sliders = DB::table('slider')

                ->select('slider.*','slider_description.*')

                ->join('slider_description','slider_description.slider_id','=','slider.id')

                ->where('id','=',$slider_id)

                ->get();

            $sliders = json_decode(json_encode($sliders));

            return response()->json(['success' =>true, "data"=> $sliders], $this-> successStatus);

        }

        return response(['message' => 'Error, check your details'], 400); 

    }

    





    ////////////Update data\\\\\\\\\\\\\\\\

    public function update(Request $request,$id){

        $category = Slider::find($id);

        //dd($request);

        if(is_null($category)){

         return response()->json(["success"=>false,"data"=>"","message"=>"Record not Found"],404);

        }

        $data = Validator::make($request->all(), [ 

       'title' => 'required', 

       'button_text' => 'required', 

       'description' => 'required', 

        ]);

        $data = $request->all();

        $sort_order = (!empty($data['sort_order'])) ? $data['sort_order'] : "";

        if($sort_order !=""){

           $test=Slider::where(['id'=>$id])->update(['sort_order'=>$data['sort_order']]);

        }

        if($request->hasFile('image')){

            $image_tmp = $request->image; //Input::file('image');

            if($image_tmp->isValid()){

              $extension = $image_tmp->getClientOriginalExtension();

              $filename = rand(111,99999).'.'.$extension;

              $image_path = 'images/slider/'.$filename;

              Image::make($image_tmp)->save($image_path);

              $sliders->image = $filename;

            }

       }

       if($request->hasFile('baner')){

            $image_tmp = $request->baner; //Input::file('image');

            if($image_tmp->isValid()){

              $extension = $image_tmp->getClientOriginalExtension();

              $filename = rand(111,99999).'.'.$extension;

              $image_path = 'images/slider/'.$filename;

              Image::make($image_tmp)->save($image_path);

              $sliders->baner = $filename;

            }

       }

       $data = $request->all();

       $count_items = count($data['language']);

       for($i = 0; $i<$count_items; $i++)

        {

            $lang_id = Language::where('name',$data['language'][$i])->pluck('language_id')->first();

              // dd($data['lang_id']);

            $prescription = SliderDescription::where('language_id',$lang_id)->where('slider_id',$id);

            $prescription->update([

                'title'=>$data['title'][$i],

                'button_text'=>$data['button_text'][$i],

                'description'=>$data['description'][$i],

            ]);

       }



        $sliders = DB::table('slider')

          ->select('slider.*','slider_description.*')

          ->join('slider_description','slider_description.slider_id','=','slider.id')

          ->where('id','=',$id)

          ->get();

      $sliders = json_decode(json_encode($sliders));

      return response()->json(['success' =>true, "data"=> $sliders], $this-> successStatus);

    }       

    

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $slider=Slider::find($id);

        if(is_null($slider)){

           return response()->json(["success"=>false, "message"=>"Record not Found"],404);

        }

        $slider->delete();

        return response()->json(["success"=>true,"message"=>"Record have been deleted Successfully"],204);

    }

}

