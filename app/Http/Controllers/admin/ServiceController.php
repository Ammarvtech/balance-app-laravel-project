<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Image;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::get();
        $services = json_decode(json_encode($services));
        //echo "<pre>"; print_r($products); die;
        $page_title = "Features";
        return view('admin.view_service')->with(compact('services','page_title'));
    }

    

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addService()
    {
    
        //echo "<pre>"; print_r($products); die;
        $page_title = "Add Feature";
        return view('admin.add_service')->with(compact('page_title'));
       
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->isMethod('post')){
            $data = request()->validate([
                'title' => 'required',
                'description' => 'required'
            ]);

            $data = $request->all();
            $slider = new Service;
            $slider->title = $data['title'];
            
           
            // Upload Image
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
                    $slider->image = $filename;
                }
            }
            
            $slider->description = (!empty($data['description'])) ? $data['description'] : "";

            $slider->save();
            /*return redirect()->back()->with('flash_message_success','Product has been added successfully!');*/
            return redirect('view-service')->with('flash_message_success','Client  has been registered successfully!');
        
         }
        $page_title = "Add Service";
        return view('admin.add_service')->with(compact('page_title'));
    
    }

     public function editService(Request $request, $id = null){

        if($request->isMethod('post')){
            $data = request()->validate([
                'description' => 'required'
            ]);

            $data = $request->all();
            $new_array  = array(
                'title' => $data['title'],
                'description' => (!empty($data['description'])) ? $data['description'] : "",
            );
            if($request->hasFile('image')){
                $image_tmp = $request->image; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/services/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    //Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    //Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    // Store image name in products table
                    $new_array['image'] = $filename;
                }
            }
             

            Service::where(['id'=>$id])->update($new_array);
            return redirect('view-service')->with('flash_message_success','Client Record updated Successfully!');
        }
        $serviceDetails = Service::where(['id'=>$id])->first();        
        $page_title = "Edit Services";
        return view('admin.edit_service')->with(compact('serviceDetails','page_title'));
    }

     public function deleteService(Request $request, $id = null){
               if(!empty($id)){
            Service::where(['id'=>$id])->delete();


            return redirect()->back()->with('flash_message_success','Client data deleted Successfully!');
        }
    }
}
