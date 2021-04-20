<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Image;
use App\Page;
use App\PageDescription;
use Illuminate\Support\Facades\DB;
use App\Language;
use Illuminate\Http\Request;

class PagesController extends Controller
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
        $pages = DB::table('page')
            ->select('page.*','pages_description.*')
                ->join('pages_description','pages_description.page_id','=','page.id')
                ->where('language_id','=',1)
                ->get();
        //dd( $data['features']);
        $page_title = "Page's Sections";
        return view('admin.view_page')->with(compact('pages','page_title'));
    }

    

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPage()
    {
    
        //echo "<pre>"; print_r($products); die;
        $page_title = "Add Page's Section";
        $languages=Language::get();
        return view('admin.add_page')->with(compact('languages','page_title'));
       
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
                "body"    => "required|array|min:1",
                "body.*"  => "required|string|min:1",
                "sort_order"  => "required|integer|max:20",
                "type"  => "required|string|min:1",
                
            ]);
            $data = $request->all();
            $page = new page; 
            $page->sort_order = $data['sort_order'];
            $page->type = $data['type'];
              if($request->hasFile('image')){
                $image_tmp = $request->image; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/sections/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    //Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    // Store image name in products table
                    $page->image = $filename;
                }
            }
            $page->save();
            //dd($feature);
            $page_id=Page::orderBy('id', 'DESC')->pluck('id')->first();
            //dd($feature_id);
            $data = $request->all();
            $finalArray = array();
            for($i=0; $i < count($data['language_id']);  $i++){
                array_push($finalArray, array(
                    'page_id'=> $page_id,
                    'language_id'=>$data['language_id'][$i],
                    'title'=>$data['title'][$i], 
                    'body'=>$data['body'][$i] )
                );
            }
            PageDescription::insert($finalArray);
            return redirect('view-page')->with('flash_message_success','Page  has been registered successfully!');      
        }
        $page_title = "Add Page's Section";
        return view('admin.add_page')->with(compact('page_title'));
    }

    public function editPage(Request $request, $id){
           
            if($request->isMethod('post')){
                $data = $request->validate([
                    "title"    => "required|array|min:1",
                    "title.*"  => "required|string|min:1",
                    "body"    => "required|array|min:1",
                    "body.*"  => "required|string|min:1",
                    "sort_order"  => "required|integer|max:20",
                    
                ]);
            $data = $request->all();
            // Upload Image
            if($request->hasFile('image')){
                $image_tmp = $request->image; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path ='images/sections/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    //Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    // Store image name in products table
                    //$testimonial->image = $filename;
                    Page::where(['id'=>$id])->update([
                'image'=>$filename]);
                }
            }
            // if($request->hasFile('image')){
            //    $image = $this->uploadImage($request->image);
            //    Testimonial::where(['id'=>$id])->update('image',$image);
            // }
            $test=Page::where(['id'=>$id])->update([
                'sort_order'=>$data['sort_order']
            ]);
            $data = $request->all();
            $count_items = count($data['language_id']);
            for($i = 0; $i<$count_items; $i++)
            {
                $prescription = PageDescription::where('language_id',$data['language_id'][$i])->where('page_id',$id);
                $prescription->update([
                   
                    'title'=>$data['title'][$i],
                    'body'=>$data['body'][$i] 
                ]);
             }

            return redirect('view-page')->with('flash_message_success','Page Record updated Successfully!');
        }

        $pages = DB::table('page')
            ->select('page.*','language.*','pages_description.*')
                ->join('pages_description','pages_description.page_id','=','page.id')
                ->join('language','language.language_id','=','pages_description.language_id')
                ->where('pages_description.page_id','=',$id)
                ->get();  
        //dd($features);
        $page_title = "Edit Page's Section";
        $id=$id;
        $languages=Language::get();
        return view('admin.edit_page')->with(compact('languages','id','pages','page_title'));
    }

     public function deletePage(Request $request, $id = null){
               if(!empty($id)){
            Page::where(['id'=>$id])->delete();


            return redirect()->back()->with('flash_message_success','Section data has been deleted Successfully!');
        }
    }
        private function uploadImage($image){
            $image_tmp = $image; //Input::file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;
                $image_path = 'images/sections'.$filename;
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


