<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Image;

use App\Category;

use App\User;

use App\CategoryDescription;

use Illuminate\Support\Facades\DB;

use App\Language;

use Illuminate\Http\Request;



class CategoryController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function viewCategories()

    {

      // $features = FeatureTranslation::get();

      // $features = json_decode(json_encode($features));

      $categories = DB::table('category')

        ->select('category.*','category_description.*')

            ->join('category_description','category_description.category_id','=','category.id')

            ->where('language_id','=',1)

            ->paginate(10);

      $page_title = "Categories";

      $users=User::get();

      $user_id = '';

      $title = "";

      return view('admin.view_categories')->with(compact('users','categories','page_title', 'user_id', 'title'));

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function searchCategories(Request $request)

    {

        $data['page_title'] = "Categories";
        $admin_id=  Auth::user()->id;
      //  dd($admin_id);
        if($admin_id != $request->user_id){
            $data['user_id'] = $request->user_id ? $request->user_id : "0";
            
        }else{
            $data['user_id'] = "0";
        }

        

        $data['title'] = $request->title ? $request->title : "";

        $data['categories'] = Category::searchCategories($data);

        $data['users'] = User::get();

        return view('admin.view_categories', $data);



    }



    



       /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function addCategory()

    {

    

        //echo "<pre>"; print_r($products); die;

        $page_title = "Add Categories";

        $languages=Language::get();

        return view('admin.add_category')->with(compact('languages','page_title'));

       

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

                

            ]);



            $data = $request->all();

            $feature = new Category; 

            $feature->user_id ="0";

            $feature->sort_order = $data['sort_order'];

            if($request->hasFile('icon')){
                $image_tmp = $request->icon; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path ='images/categories/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);

                    //Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    // Store image name in products table

                    $feature->icon = $filename;

                }

            }

            $feature->save();

            //dd($feature);

            $feature_id=Category::orderBy('id', 'DESC')->pluck('id')->first();

            //dd($feature_id);

            $data = $request->all();

            $finalArray = array();

            for($i=0; $i < count($data['language_id']);  $i++){

                array_push($finalArray, array(

                    'category_id'=> $feature_id,

                    'language_id'=>$data['language_id'][$i],

                    'title'=>$data['title'][$i],

                    'description'=>$data['description'][$i] )

                );

            }

            CategoryDescription::insert($finalArray);
            return redirect('view-categories')->with('flash_message_success','Category added successfully!');      

        }

       

        $page_title = "Add Category";

        $languages=Language::get();

        return view('admin.add_category')->with(compact('languages','page_title'));

    }



    public function editCategory(Request $request, $id){

        

            if($request->isMethod('post')){

                $data = $request->validate([

                  "title"    => "required|array|min:1",

                  "title.*"  => "required|string|min:1",

                  "description"    => "required|array|min:1",

                  "description.*"  => "required|string|min:1",

                  "sort_order"  => "required|integer|max:20",                 

                ]);

            $data = $request->all();

            if($request->hasFile('icon')){
                $image_tmp = $request->icon; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/categories/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    //Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                    // Store image name in products table
                    //$data['icon'] = $filename;
                    Category::where(['id'=>$id])->update(['icon'=>$filename]);
                }

            }

            $test=Category::where(['id'=>$id])->update(['sort_order'=>$data['sort_order']]);

            $data = $request->all();

            $count_items = count($data['language_id']);

            for($i = 0; $i<$count_items; $i++)

            {

                $prescription = CategoryDescription::where('language_id',$data['language_id'][$i])->where('category_id',$id);

                $prescription->update([

                   

                    'title'=>$data['title'][$i],

                    'description'=>$data['description'][$i] 

                ]);

             }



            return redirect('view-categories')->with('flash_message_success','Category Record updated Successfully!');

        }



        $categories = DB::table('category')

            ->select('category.*','language.*','category_description.*')

                ->join('category_description','category_description.category_id','=','category.id')

                ->join('language','language.language_id','=','category_description.language_id')

                ->where('category_description.category_id','=',$id)

                ->get();  



        //dd($features);

        $page_title = "Edit Category";

        $id=$id;

        return view('admin.edit_category')->with(compact('id','categories','page_title'));

    }



    public function deleteCategory(Request $request, $id = null){

        if(!empty($id)){

            Category::where(['id'=>$id])->delete();

            CategoryDescription::where(['category_id'=>$id])->delete();

            return redirect()->back()->with('flash_message_success','Category deleted Successfully!');

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