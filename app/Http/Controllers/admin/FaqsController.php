<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Image;
use App\Faq;
use App\FaqDescription;
use Illuminate\Support\Facades\DB;
use App\Language;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewFaq()
    {
        // $features = FeatureTranslation::get();
        // $features = json_decode(json_encode($features));
        $faqs = DB::table('faq')
            ->select('faq.*','faq_description.*')
                ->join('faq_description','faq_description.faq_id','=','faq.id')
                ->where('language_id','=',1)
                ->get();
        //dd( $data['features']);
        $page_title = "faqs";
        return view('admin.view_faqs')->with(compact('faqs','page_title'));
    }

    

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFaq()
    {
    
        //echo "<pre>"; print_r($products); die;
        $page_title = "Add Faq";
        $languages=Language::get();
        return view('admin.add_faq')->with(compact('languages','page_title'));
       
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
            //     'question' => 'required',
            //     'sort_order' => 'required',
            //     'answer' => 'required'
            // ]);
            $data = $request->validate([
                "question"    => "required|array|min:1",
                "question.*"  => "required|string|min:1",
                "answer"    => "required|array|min:1",
                "answer.*"  => "required|string|min:1",
                "sort_order"  => "required|integer|max:20",
                
            ]);
            $data = $request->all();
            $feature = new Faq; 
            $feature->sort_order = $data['sort_order'];
            $feature->save();
            //dd($feature);
            $feature_id=Faq::orderBy('id', 'DESC')->pluck('id')->first();
            //dd($feature_id);
            $data = $request->all();
            $finalArray = array();
            for($i=0; $i < count($data['language_id']);  $i++){
                array_push($finalArray, array(
                    'faq_id'=> $feature_id,
                    'language_id'=>$data['language_id'][$i],
                    'question'=>$data['question'][$i],
                    'answer'=>$data['answer'][$i] )
                );
            }
            FaqDescription::insert($finalArray);
            return redirect('view-faqs')->with('flash_message_success','Faq  has been registered successfully!');      
        }
        $page_title = "Add Faq";
        return view('admin.add_faq')->with(compact('page_title'));
    }

    public function editFaq(Request $request, $id){
        
            if($request->isMethod('post')){
                $data = $request->validate([
                    "question"    => "required|array|min:1",
                    "question.*"  => "required|string|min:1",
                    "answer"    => "required|array|min:1",
                    "answer.*"  => "required|string|min:1",
                    "sort_order"  => "required|integer|max:20",
                    
                ]);
           // dd($data);
            $data = $request->all();
            $test=Faq::where(['id'=>$id])->update(['sort_order'=>$data['sort_order']]);
            $data = $request->all();
            $count_items = count($data['language_id']);
            for($i = 0; $i<$count_items; $i++)
            {
                $prescription = FaqDescription::where('language_id',$data['language_id'][$i])->where('faq_id',$id);
                $prescription->update([
                   
                    'question'=>$data['question'][$i],
                    'answer'=>$data['answer'][$i] 
                ]);
             }

            return redirect('view-faqs')->with('flash_message_success','Faqs Record updated Successfully!');
        }

        $faq = DB::table('faq')
            ->select('faq.*','language.*','faq_description.*')
                ->join('faq_description','faq_description.faq_id','=','faq.id')
                ->join('language','language.language_id','=','faq_description.language_id')
                ->where('faq_description.faq_id','=',$id)
                ->get();  
        //dd($features);
        $page_title = "Edit Faq";
        $id=$id;
        $languages=Language::get();
        return view('admin.edit_faq')->with(compact('languages','id','faq','page_title'));
    }

     public function deleteFaq(Request $request, $id = null){
               if(!empty($id)){
            Faq::where(['id'=>$id])->delete();
            FaqDescription::where(['faq_id'=>$id])->delete();


            return redirect()->back()->with('flash_message_success','Faq data deleted Successfully!');
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


















// <?php

// namespace App\Http\Controllers\admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;
// use Auth;
// use Session;
// use App\Faq;

// class FaqsController extends Controller
// {
//     public function addFaqs(Request $request){
//         if($request->isMethod('post')){
//             $data = request()->validate([
//                 'question' => 'required',
//                 'answer' => 'required'
//             ]);

//             $data = $request->all();
//             $faqs = new Faq;
//             $faqs->question = $data['question'];
//             $faqs->answer = $data['answer'];            
//             if(!empty($data['answer'])){
//                 $faqs->save();
//                 return redirect('view-faqs')->with('flash_message_success','Faq\'s has been added successfully!');
//             }
//     	}
//     	$page_title = "Add Faq's";
//     	return view('admin.add_faq')->with(compact('page_title'));
//     }

//     public function viewFaq(){
//         $faqs = DB::table('faqs')->paginate(10);
//         $page_title = "Faqs";
        
//         return view('admin.view_faqs')->with(compact('faqs','page_title'));
//     }

//     public function editFaq(Request $request, $id = null){
//         if($request->isMethod('post')){
//             $data = request()->validate([
//                 'question' => 'required',
//                 'answer' => 'required'
//             ]);
            
//             $data = $request->all();
//             $newArray = array(
//                 'question' => $data['question'],
//                 'answer' => $data['answer']
//             );
//             Faq::where(['id'=>$id])->update($newArray);
//             return redirect('view-faqs')->with('flash_message_success','Faq\'s details updated Successfully!');
//         }

//         $page_title = "Edit Faq";
//         $faqsDetails = Faq::where(['id'=>$id])->first();        
//         return view('admin.edit_faq')->with(compact('faqsDetails','page_title'));
//     }

//     public function deleteFaq($id = null){
//         if(!empty($id)){
//             Faq::where(['id'=>$id])->delete();
//             return redirect()->back()->with('flash_message_success','Faq\'s deleted Successfully!');
//         }
//     }
// }
