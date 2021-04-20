<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Image;
use Validator;
use App\Feature;
use App\FeatureTranslation;
use Illuminate\Support\Facades\DB;
use App\Language;
use Illuminate\Http\Request;

class FeatureController extends Controller
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
        $features = DB::table('feature')
            ->select('feature.*','feature_description.*')
                ->join('feature_description','feature_description.feature_id','=','feature.id')
                ->where('language_id','=',1)
                ->get();
        //dd( $data['features']);
        $page_title = "Features";
        return view('admin.view_feature')->with(compact('features','page_title'));
    }

    

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFeature()
    {
    
        //echo "<pre>"; print_r($products); die;
        $page_title = "Add Feature";
        $languages=Language::get();
        return view('admin.add_feature')->with(compact('languages','page_title'));
       
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
            // $this->validate($request, [
            //     'title' => 'required|min:2',
            //     'sort_order' => 'required|integer',
            //     '*.description'    => 'required|min:2',
            // ]);
            $data = $request->validate([
                "title"    => "required|array|min:1",
                "title.*"  => "required|string|min:1",
                "description"    => "required|array|min:1",
                "description.*"  => "required|string|min:1",
                "sort_order"  => "required|integer|max:20",
                
            ]);
            $data = $request->all();
            $feature = new Feature; 
            $feature->sort_order = $data['sort_order'];
            if($request->hasFile('image')){
                $file = $request->image;
                $name = $file->getClientOriginalName();
                if($file->move('images/Features/',$name)){
                    $feature->image=$name;
                }
            }
            // if ($request->hasFile('image')) {
            //   $feature->image  = $request->file('image');
            //   //->store('images/Features/');
            // }

            $feature->save();
            //dd($feature);
            $feature_id=Feature::orderBy('id', 'DESC')->pluck('id')->first();
            //dd($feature_id);
            $data = $request->all();
            $finalArray = array();
            for($i=0; $i < count($data['language_id']);  $i++){
                array_push($finalArray, array(
                    'feature_id'=> $feature_id,
                    'language_id'=>$data['language_id'][$i],
                    'title'=>$data['title'][$i],
                    'description'=>$data['description'][$i] )
                );
            }
            FeatureTranslation::insert($finalArray);
            return redirect('view-feature')->with('flash_message_success','Client  has been registered successfully!');      
        }
        $page_title = "Add Feature";
        $languages=Language::get();
        return view('admin.add_feature')->with(compact('languages','page_title'));
    }

    public function editFeature(Request $request, $id){
            if($request->isMethod('post')){
            // $data = request()->validate([
            //     'title' => 'required',
            //     'sort_order' => 'required',
            //     'description' => 'required'
            // ]);
            $data = $request->validate([
                "title"    => "required|array|min:1",
                "title.*"  => "required|string|min:1",
                "description"    => "required|array|min:1",
                "description.*"  => "required|string|min:1",
                "sort_order"  => "required|integer|max:20",
            ]);
            $data = $request->all();
            $test=Feature::where(['id'=>$id])->update(['sort_order'=>$data['sort_order'], 'isDelete' => $data['isDelete']]);
            // if($request->hasFile('image')){
            //     $image_tmp = $request->image; //Input::file('image');
            //     if($image_tmp->isValid()){
            //         $extension = $image_tmp->getClientOriginalExtension();
            //         $filename = rand(111,99999).'.'.$extension;
            //         $image_path = 'images/Features/'.$filename;
            //         // Resize Images
            //         Image::make($image_tmp)->save($image_path);
            //         //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
            //         //Image::make($image_tmp)->resize(300,300)->save($small_image_path);

            //         // Store image name in products table
            //         $data['image'] = $filename;
            //         Feature::where(['id'=>$id])->update([
            //         'image'=>$filename]);

            //     }
            // }
            if($request->hasFile('image')){
                $file = $request->image;
                $name = $file->getClientOriginalName();
                if($file->move('images/Features/',$name)){
                    $data['image'] = $name;
                    Feature::where(['id'=>$id])->update([
                    'image'=>$data['image']]);
                }
            }

            $data = $request->all();
            $count_items = count($data['language_id']);
            for($i = 0; $i<$count_items; $i++)
            {
                $prescription = FeatureTranslation::where('language_id',$data['language_id'][$i])->where('feature_id',$id);
                $prescription->update([
                   
                    'title'=>$data['title'][$i],
                    'description'=>$data['description'][$i] 
                ]);
             }

            return redirect('view-feature')->with('flash_message_success','Feature Record updated Successfully!');
        }

        $features = DB::table('feature')
            ->select('feature.*','language.*','feature_description.*')
                ->join('feature_description','feature_description.feature_id','=','feature.id')
                ->join('language','language.language_id','=','feature_description.language_id')
                ->where('feature_description.feature_id','=',$id)
                ->get(); 
        $page_title = "Edit Feature";
        $id=$id;
        $languages=Language::get();
        return view('admin.edit_feature')->with(compact('languages','id','features','page_title'));
    }

     public function deleteFeature(Request $request, $id = null){
               if(!empty($id)){
            Feature::where(['id'=>$id])->delete();


            return redirect()->back()->with('flash_message_success','Feature data deleted Successfully!');
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

