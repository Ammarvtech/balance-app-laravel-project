<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Image;
use App\Testimonial;
use App\TestimonialDescription;
use Illuminate\Support\Facades\DB;
use App\Language;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $features = FeatureTranslation::get();
        // $features = json_decode(json_encode($features));
        $testimonials = DB::table('testimonial')
            ->select('testimonial.*','testimonial_description.*')
                ->join('testimonial_description','testimonial_description.testimonial_id','=','testimonial.id')
                ->where('language_id','=',1)
                ->get();
        //dd( $data['features']);
        $page_title = "Testimonials";
        return view('admin.view_testimonial')->with(compact('testimonials','page_title'));
    }

    

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTestimonial()
    {
    
        //echo "<pre>"; print_r($products); die;
        $page_title = "Add Testimonial";
        $languages=Language::get();
        return view('admin.add_testimonial')->with(compact('languages','page_title'));
       
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
            // $data = request()->validate([
            //     'testimonial_name' => 'required',
            //     'designation' => 'required',
            //     'description' => 'required',
            //     'sort_order' => 'required',
            // ]);
            $data = $request->validate([
                "testimonial_name"    => "required|array|min:1",
                "testimonial_name.*"  => "required|string|min:1",
                "designation"    => "required|array|min:1",
                "designation.*"  => "required|string|min:1",
                "description"    => "required|array|min:1",
                "description.*"  => "required|string|min:1",
                "sort_order"  => "required|integer|max:20",
                
            ]);
            $data = $request->all();
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
            //dd($feature);
            $testimonial_id=Testimonial::orderBy('id', 'DESC')->pluck('id')->first();
            //dd($feature_id);
            $data = $request->all();
            $finalArray = array();
            for($i=0; $i < count($data['language_id']);  $i++){
                array_push($finalArray, array(
                    'testimonial_id'=> $testimonial_id,
                    'language_id'=>$data['language_id'][$i],
                    'testimonial_name'=>$data['testimonial_name'][$i],
                    'designation'=>$data['designation'][$i], 
                    'description'=>$data['description'][$i] )
                );
            }
            TestimonialDescription::insert($finalArray);
            return redirect('view-testimonial')->with('flash_message_success','Testimonial  has been registered successfully!');      
        }
        $page_title = "Add Testimonial";
        return view('admin.add_testimonial')->with(compact('page_title'));
    }

    public function editTestimonial(Request $request, $id){
           
            if($request->isMethod('post')){
                $data = $request->validate([
                    "testimonial_name"    => "required|array|min:1",
                    "testimonial_name.*"  => "required|string|min:1",
                    "designation"    => "required|array|min:1",
                    "designation.*"  => "required|string|min:1",
                    "description"    => "required|array|min:1",
                    "description.*"  => "required|string|min:1",
                    "sort_order"  => "required|integer|max:20",
                    
                ]);
            $data = $request->all();
            // Upload Image
            if($request->hasFile('image')){
                $image_tmp = $request->image; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path ='images/testimonials/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    //Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    // Store image name in products table
                    //$testimonial->image = $filename;
                    Testimonial::where(['id'=>$id])->update([
                'image'=>$filename]);
                }
            }
            // if($request->hasFile('image')){
            //    $image = $this->uploadImage($request->image);
            //    Testimonial::where(['id'=>$id])->update('image',$image);
            // }
            $test=Testimonial::where(['id'=>$id])->update([
                'sort_order'=>$data['sort_order']
            ]);
            $data = $request->all();
            $count_items = count($data['language_id']);
            for($i = 0; $i<$count_items; $i++)
            {
                $prescription = TestimonialDescription::where('language_id',$data['language_id'][$i])->where('testimonial_id',$id);
                $prescription->update([
                   
                    'testimonial_name'=>$data['testimonial_name'][$i],
                    'designation'=>$data['designation'][$i],
                    'description'=>$data['description'][$i] 
                ]);
             }

            return redirect('view-testimonial')->with('flash_message_success','Testimonial Record updated Successfully!');
        }

        $testimonials = DB::table('testimonial')
            ->select('testimonial.*','language.*','testimonial_description.*')
                ->join('testimonial_description','testimonial_description.testimonial_id','=','testimonial.id')
                ->join('language','language.language_id','=','testimonial_description.language_id')
                ->where('testimonial_description.testimonial_id','=',$id)
                ->get();  
        //dd($features);
        $page_title = "Edit Testimonial";
        $id=$id;
        $languages=Language::get();
        return view('admin.edit_testimonial')->with(compact('languages','id','testimonials','page_title'));
    }

     public function deleteTestimonial(Request $request, $id = null){
               if(!empty($id)){
            Testimonial::where(['id'=>$id])->delete();


            return redirect()->back()->with('flash_message_success','Testimonial data deleted Successfully!');
        }
    }
        private function uploadImage($image){
            $image_tmp = $image; //Input::file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;
                $image_path = 'images/slider'.$filename;
                Image::make($image_tmp)->save($image_path);
                return $filename;
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
}

