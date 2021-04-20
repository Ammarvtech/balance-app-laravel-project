<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Image;

use App\Slider;

use App\AppSLider;

use App\SliderDescription;

use App\AppSLiderDescription;

use Illuminate\Support\Facades\DB;

use App\Language;

use Illuminate\Http\Request;



class SliderController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function viewSlider()

    {

        // $features = FeatureTranslation::get();

        // $features = json_decode(json_encode($features));

        $sliders = DB::table('slider')

            ->select('slider.*','slider_description.*')

                ->join('slider_description','slider_description.slider_id','=','slider.id')

                ->where('language_id','=',1)

                ->get();

       // dd( $sliders);

        $page_title = "Sliders";

        return view('admin.view_slider')->with(compact('sliders','page_title'));

    }



    



       /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function addSlider()

    {

    

        //echo "<pre>"; print_r($products); die;

        $page_title = "Add Sliders";

        $languages=Language::get();

        return view('admin.add_slider')->with(compact('languages','page_title'));

       

    }





     /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create(Request $request)

    {

        //dd($request);

        if($request->isMethod('post')){



            $data = $request->validate([

                "title"    => "required|array|min:1",

                "title.*"  => "required|string|min:1",

                "description"    => "required|array|min:1",

                "description.*"  => "required|string|min:1",

                "sort_order"  => "required|integer|max:20",

                "image"  => "required",

                "baner"  => "required",

                

            ]);

            $data = $request->all();

            $slider = new Slider; 

            $slider->sort_order = $data['sort_order'];

              if($request->hasFile('image')){

                $image_tmp = $request->image; //Input::file('image');

                if($image_tmp->isValid()){

                    $extension = $image_tmp->getClientOriginalExtension();

                    $filename = rand(111,99999).'.'.$extension;

                    $image_path ='images/slider/'.$filename;

                    // Resize Images

                    Image::make($image_tmp)->save($image_path);

                    //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);

                    //Image::make($image_tmp)->resize(300,300)->save($small_image_path);



                    // Store image name in products table

                    $slider->image = $filename;

                }

            }

            if($request->hasFile('baner')){

                $file = $request->baner;

                $name = $file->getClientOriginalName();

                if($file->move('images/slider/',$name)){

                    $slider->baner=$name;

                }

            }

            $slider->save();

            //dd($feature);

            $slider_id=Slider::orderBy('id', 'DESC')->pluck('id')->first();

            //dd($feature_id);

            $data = $request->all();

            $finalArray = array();

            for($i=0; $i < count($data['language_id']);  $i++){

                array_push($finalArray, array(

                    'slider_id'=> $slider_id,

                    'language_id'=>$data['language_id'][$i],

                    'title'=>$data['title'][$i],

                  

                    'description'=>$data['description'][$i],

                    /*'button_text'=>$data['button_text'][$i],*/

                    

                     )

                );

            }

            SliderDescription::insert($finalArray);

            return redirect('view-slider')->with('flash_message_success','Slider  has been registered successfully!');      

        }

        $page_title = "Add Slider";

        return view('admin.add_slider')->with(compact('page_title'));

    }



    public function editSlider(Request $request, $id){

          //dd($request);

            if($request->isMethod('post')){

                $data = $request->validate([

                    "title"    => "required|array|min:1",

                    "title.*"  => "required|string|min:1",

                    "description"    => "required|array|min:1",

                    "description.*"  => "required|string|min:1",

                    "sort_order"  => "required|integer|max:20",

                    

                ]);

            $data = $request->all();

           // dd($data);

            // Upload Image

            if($request->hasFile('image')){

                $image_tmp = $request->image; //Input::file('image');

                if($image_tmp->isValid()){

                    $extension = $image_tmp->getClientOriginalExtension();

                    $filename = rand(111,99999).'.'.$extension;

                    $image_path = 'images/slider/'.$filename;

                    // Resize Images

                    Image::make($image_tmp)->save($image_path);

                    //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);

                    //Image::make($image_tmp)->resize(300,300)->save($small_image_path);



                    // Store image name in products table

                    $data['image'] = $filename;

                    Slider::where(['id'=>$id])->update([

                    'image'=>$filename]);



                }

            }



            if($request->hasFile('baner')){

                $file = $request->baner;

                $name = $file->getClientOriginalName();

                if($file->move('images/slider/',$name)){

                     Slider::where(['id'=>$id])->update([

                    'baner'=>$name]);

                }

            }

            $test=Slider::where(['id'=>$id])->update([

                'sort_order'=>$data['sort_order'],

            ]);

            $data = $request->all();

            $count_items = count($data['language_id']);

            for($i = 0; $i<$count_items; $i++)

            {

                $prescription = SliderDescription::where('language_id',$data['language_id'][$i])->where('slider_id',$id);

                $prescription->update([

                   

                    'title'=>$data['title'][$i],

                    'description'=>$data['description'][$i],

                    /*'button_text'=>$data['button_text'][$i]*/

                ]);

             }



            return redirect('view-slider')->with('flash_message_success','Slider Record updated Successfully!');

        }



        $sliders = DB::table('slider')

            ->select('slider.*','language.*','slider_description.*')

                ->join('slider_description','slider_description.slider_id','=','slider.id')

                ->join('language','language.language_id','=','slider_description.language_id')

                ->where('slider_description.slider_id','=',$id)

                ->get();  

        //dd($features);

        $page_title = "Edit Sliders";

        $id=$id;

        $languages=Language::get();

        return view('admin.edit_slider')->with(compact('languages','id','sliders','page_title'));

    }



     public function deleteSlider(Request $request, $id = null){

               if(!empty($id)){

            Slider::where(['id'=>$id])->delete();





            return redirect()->back()->with('flash_message_success','Slider data deleted Successfully!');

        }

    }

        // public function set_language($val){

        //     $cookie= array(

        //         'name'   => 'language',

        //         'value'  => $val,

        //         'expire' => time()+'86400'*365,

        //     );

        //     $this->input->set_cookie($cookie);

        // }

//////////////////////////////////   App Slider /////////////////////////////////////

    public function viewAppSlider()

    {
        $sliders = DB::table('app_slider')

            ->select('app_slider.*','app_slider_description.*')

                ->join('app_slider_description','app_slider_description.app_slider_id','=','app_slider.id')

                ->where('language_id','=',1)

                ->get();

        $page_title = "App Sliders";

        return view('admin.view_app_slider')->with(compact('sliders','page_title'));
    }

    public function addAppSlider(){
        $page_title = "Add App Sliders";
        $languages=Language::get();
        return view('admin.add_app_slider')->with(compact('languages','page_title'));
    }

    public function appCreate(Request $request){
        if($request->isMethod('post')){
            $data = $request->validate([
                "title"    => "required|array|min:1",
                "title.*"  => "required|string|min:1",
                "description"    => "required|array|min:1",
                "description.*"  => "required|string|min:1",
                "sort_order"  => "required|integer|max:20",
                "image"  => "required",
            ]);
            $data = $request->all();
            $slider = new AppSlider; 
            $slider->sort_order = $data['sort_order'];
            if($request->hasFile('image')){
                $image_tmp = $request->image;
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path ='images/slider/'.$filename;
                    Image::make($image_tmp)->save($image_path);
                    $slider->image = $filename;
                }
            }
            $slider->save();
            $slider_id = AppSlider::orderBy('id', 'DESC')->pluck('id')->first();
            $data = $request->all();
            $finalArray = array();
            for($i=0; $i < count($data['language_id']);  $i++){
                array_push($finalArray, array(
                    'app_slider_id'=> $slider_id,
                    'language_id'=>$data['language_id'][$i],
                    'title'=>$data['title'][$i],
                    'description'=>$data['description'][$i],
                     )
                );
            }
            AppSLiderDescription::insert($finalArray);
            return redirect('view-app-slider')->with('flash_message_success','Slider  has been registered successfully!');      
        }
        $page_title = "Add Slider";
        return view('admin.add_app_slider')->with(compact('page_title'));

    }
    public function editAppSlider(Request $request, $id){
            if($request->isMethod('post')){
                $data = $request->validate([
                    "title"    => "required|array|min:1",
                    "title.*"  => "required|string|min:1",
                    "description"    => "required|array|min:1",
                    "description.*"  => "required|string|min:1",
                    "sort_order"  => "required|integer|max:20",
                ]);
            $data = $request->all();
            if($request->hasFile('image')){
                $image_tmp = $request->image;
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/slider/'.$filename;
                    Image::make($image_tmp)->save($image_path);
                    $data['image'] = $filename;
                    AppSlider::where(['id'=>$id])->update([
                    'image'=>$filename]);
                }
            }

            $test = AppSlider::where(['id'=>$id])->update([

                'sort_order'=>$data['sort_order'],

            ]);

            $data = $request->all();

            $count_items = count($data['language_id']);

            for($i = 0; $i<$count_items; $i++)

            {
                $prescription = AppSliderDescription::where('language_id',$data['language_id'][$i])->where('app_slider_id',$id);
                $prescription->update([
                    'title'=>$data['title'][$i],
                    'description'=>$data['description'][$i],
                ]);
             }
            return redirect('view-app-slider')->with('flash_message_success','Slider Record updated Successfully!');

        }

        $sliders = DB::table('app_slider')

            ->select('app_slider.*','language.*','app_slider_description.*')

                ->join('app_slider_description','app_slider_description.app_slider_id','=','app_slider.id')

                ->join('language','language.language_id','=','app_slider_description.language_id')

                ->where('app_slider_description.app_slider_id','=',$id)

                ->get();  

        //dd($features);

        $page_title = "Edit App Sliders";

        $id=$id;

        $languages=Language::get();

        return view('admin.edit_app_slider')->with(compact('languages','id','sliders','page_title'));

    }



     public function deleteAppSlider(Request $request, $id = null){
            if(!empty($id)){
                AppSlider::where(['id' => $id])->delete();
                AppSliderDescription::where(['app_slider_id' => $id])->delete();
            
            }

            return redirect()->back()->with('flash_message_success','Slider data deleted Successfully!');

        }


}



