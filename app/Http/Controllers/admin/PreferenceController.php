<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Image;
use App\Preference;
use App\Language;
use App\Feature;
use App\PreferenceDescription;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PreferenceController extends Controller
{

    public function index()
    {
        $page_title="Preferences";
        $preference= DB::table('preferences')
            ->select('language.*','preferences.*','preferences_descriptions.*')
                ->join('preferences_descriptions','preferences_descriptions.preference_id','=','preferences.id')
                ->join('language','language.language_id','=','preferences_descriptions.language_id')
                ->get();
       // dd($preference );
       // $languages=Language::get();
        return view('admin.preference')->with(compact('preference','page_title'));
    }


    public function create(Request $request, $id){
            if($request->isMethod('post')){
               
            
               

            $data = $request->all();
            $test=Preference::where(['id'=>$id])->update([
                'facebook_link'=>$data['facebook_link'],
                'instagram_link'=>$data['instagram_link'],
                'twitter_link'=>$data['twitter_link'],
                'linkedin_link'=>$data['linkedin_link'],
                'pinterest_link'=>$data['pinterest_link'],
                'telephone'=>$data['telephone'],
                'email'=>$data['email'],
                'footer_link'=>$data['footer_link'],
            ]);

           if($request->hasFile('logo')){
                $file = $request->logo;
                $name = $file->getClientOriginalName();
                if($file->move('images/home/',$name)){
                    $data['logo'] = $name;
                    Preference::where(['id'=>$id])->update([
                    'logo'=>$data['logo']]);
                }
            }
            if($request->hasFile('home_image1')){
                $image_tmp = $request->home_image1; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/home/'.$filename;
                    Image::make($image_tmp)->save($image_path);
                    $data['home_image1'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'home_image1'=>$filename]);
                }
            }
            if($request->hasFile('home_image2')){
                $image_tmp = $request->home_image2; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/home/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['home_image2'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'home_image2'=>$filename]);
                }
            }
            
            if($request->hasFile('feature_image1')){
                $image_tmp = $request->feature_image1; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/Features/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['feature_image1'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'feature_image1'=>$filename]);
                }
            }
            if($request->hasFile('feature_image2')){
                $image_tmp = $request->feature_image2; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/Features/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['feature_image2'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'feature_image2'=>$filename]);
                }
            }
            if($request->hasFile('feature_image3')){
                $image_tmp = $request->feature_image1; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/Features/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['feature_image3'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'feature_image3'=>$filename]);
                }
            }

            if($request->hasFile('safety_image1')){
                $image_tmp = $request->safety_image1; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/services/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['safety_image1'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'safety_image1'=>$filename]);
                }
            }

            if($request->hasFile('safety_image2')){
                $image_tmp = $request->safety_image2; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/services/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['safety_image2'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'safety_image2'=>$filename]);
                }
            }

            if($request->hasFile('safety_image3')){
                $image_tmp = $request->safety_image3; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/services/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['safety_image3'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'safety_image3'=>$filename]);
                }
            }


            if($request->hasFile('about_image1')){
                $image_tmp = $request->about_image1; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/aboutus/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['about_image1'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'about_image1'=>$filename]);
                }
            }
            if($request->hasFile('about_image2')){
                $image_tmp = $request->about_image2; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/aboutus/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['about_image2'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'about_image2'=>$filename]);
                }
            }
           if($request->hasFile('about_image3')){
                $image_tmp = $request->about_image3; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/aboutus/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['about_image3'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'about_image3'=>$filename]);
                }
            }
            // Prefereces descriptions
            $data = $request->all();
            $count_items = count($data['language_id']);
            for($i = 0; $i<$count_items; $i++)
            {
                $prescription = PreferenceDescription::where('language_id',$data['language_id'][$i])->where('preference_id',$id);
                $prescription->update([ 
                    'address'=>$data['address'][$i],
                    'footer_title'=>$data['footer_title'][$i],
                    'footer_description'=>$data['footer_description'][$i],
                    'footer_copyright'=>$data['footer_copyright'][$i],
                    'home_feature_title'=>$data['home_feature_title'][$i],
                    'home_feature_description'=>$data['home_feature_description'][$i],
                   
                    'safet_title'=>$data['safet_title'][$i],
                    'safety_description'=>$data['safety_description'][$i],
                   
                    'service_title'=>$data['service_title'][$i],
                    'service_description'=>$data['service_description'][$i],
                    'faq_heading'=>$data['faq_heading'][$i],
                    'story_title'=>$data['story_title'][$i],
                    'story_description'=>$data['story_description'][$i],
                    
                    

                   
                ]);
            }

            //dd("here");
            return redirect('preferences')->with('flash_message_success','Preferences Record updated Successfully!');
        }
        $page_title="Preferences";
        $preference= DB::table('preferences')
            ->select('language.*','preferences.*','Preferences_descriptions.*')
                ->join('Preferences_descriptions','Preferences_descriptions.preference_id','=','preferences.id')
                ->join('language','language.language_id','=','Preferences_descriptions.language_id')
                ->get();
        //dd($preference );
      //  $languages=Language::get();
         //dd("outer");
        return view('admin.preference')->with(compact('preference','page_title'));
    }

//About us
    public function about()
    {
        $page_title="About Us";
        $preference= DB::table('preferences')
            ->select('language.*','preferences.*','preferences_descriptions.*')
                ->join('preferences_descriptions','preferences_descriptions.preference_id','=','preferences.id')
                ->join('language','language.language_id','=','preferences_descriptions.language_id')
                ->get();
       // dd($preference );
       // $languages=Language::get();
        return view('admin.about')->with(compact('preference','page_title'));
    }


    public function aboutCreate(Request $request, $id){
            if($request->isMethod('post')){
              
                $data = $request->validate([
                    "about_title.*"   => "required|string|min:1",
                    "about_description.*"  => "required|string|min:1",
                    "about_heading1.*"     => "required|string|min:1",
                    "about_description1.*"  => "required|string|min:1",
                ],[], $this->validationErrors());

            if($request->hasFile('banerImage')){
                $image_tmp = $request->logo; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/home/'.$filename;
                    Image::make($image_tmp)->save($image_path);
                    $data['logo'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'banerImage'=>$filename]);
                }
            }
            
            // Prefereces descriptions
            $data = $request->all();
            $count_items = count($data['language_id']);
            for($i = 0; $i<$count_items; $i++)
            {
                $prescription = PreferenceDescription::where('language_id',$data['language_id'][$i])->where('preference_id',$id);
                $prescription->update([ 
                    'about_title'=>$data['about_title'][$i],
                    'about_description'=>$data['about_description'][$i],
                    'about_heading1'=>$data['about_heading1'][$i],
                    'about_description1'=>$data['about_description1'][$i],
                    
                ]);
            }

            //dd("here");
            return redirect('about')->with('flash_message_success','About Record updated Successfully!');
        }
        $page_title="Preferences";
        $preference= DB::table('preferences')
            ->select('language.*','preferences.*','Preferences_descriptions.*')
                ->join('Preferences_descriptions','Preferences_descriptions.preference_id','=','preferences.id')
                ->join('language','language.language_id','=','Preferences_descriptions.language_id')
                ->get();
        //dd($preference );
      //  $languages=Language::get();
         //dd("outer");
        return view('admin.about')->with(compact('preference','page_title'));
    }

    public function validationErrors(){
        $languages=Language::get();
        $errors = array();
        foreach($languages as $key=> $lang){
            $array = array();
            $array = array(
                "about_title.".$key => "Main Title of ".$lang['name'],
                "about_description.".$key => "Main Description of ".$lang['name'],
                "about_heading1.".$key => "Sub Heading of ".$lang['name'],
                "about_description1.".$key => "Sub Description of ".$lang['name'],
            );
            $errors = array_merge($errors, $array);
        }
         return $errors;
    }

    /////Feature
    public function feature()
    {
        $page_title="Preferences";
        $preference= DB::table('preferences')
            ->select('language.*','preferences.*','preferences_descriptions.*')
                ->join('preferences_descriptions','preferences_descriptions.preference_id','=','preferences.id')
                ->join('language','language.language_id','=','preferences_descriptions.language_id')
                ->get();
       // dd($preference );
       // $languages=Language::get();
        return view('admin.feature')->with(compact('preference','page_title'));
    }


    public function featureCreate(Request $request, $id){
            if($request->isMethod('post')){
                $data = $request->validate([
  
                    "feature_title"         => "required|array|min:1",
                    "feature_title.*"       => "required|string|min:1",
                    "feature_description"   => "required|array|min:1",
                    "feature_description.*" => "required|string|min:1",
                   
                ]);

            $data = $request->all();


            
            if($request->hasFile('feature_image1')){
                $image_tmp = $request->feature_image1; //Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $image_path = 'images/Features/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $data['feature_image1'] = $filename;
                    Preference::where(['id'=>$id])->update([
                    'feature_image1'=>$filename]);
                }
            }

            // Prefereces descriptions
            $data = $request->all();
            $count_items = count($data['language_id']);
            for($i = 0; $i<$count_items; $i++)
            {
                $prescription = PreferenceDescription::where('language_id',$data['language_id'][$i])->where('preference_id',$id);
                $prescription->update([ 
                    'feature_title'=>$data['feature_title'][$i],
                    'feature_description'=>$data['feature_description'][$i],
                    'sub_heading1'=>$data['sub_heading1'][$i],
                    'sub_description1'=>$data['sub_description1'][$i],
                    'sub_heading2'=>$data['sub_heading2'][$i],
                    'sub_description2'=>$data['sub_description2'][$i],
                    'sub_heading3'=>$data['sub_heading3'][$i],
                    'sub_description3'=>$data['sub_description3'][$i],
                    'sub_heading4'=>$data['sub_heading4'][$i],
                    'sub_description4'=>$data['sub_description4'][$i],
                    'sub_heading5'=>$data['sub_heading5'][$i],
                    'sub_description5'=>$data['sub_description5'][$i],
                    'sub_heading6'=>$data['sub_heading6'][$i],
                    'sub_description6'=>$data['sub_description6'][$i],

                ]);
            }

            //dd("here");
            return redirect('feature')->with('flash_message_success','Features Record updated Successfully!');
        }
        $page_title="Features";
        $preference= DB::table('preferences')
            ->select('language.*','preferences.*','Preferences_descriptions.*')
                ->join('Preferences_descriptions','Preferences_descriptions.preference_id','=','preferences.id')
                ->join('language','language.language_id','=','Preferences_descriptions.language_id')
                ->get();
        //dd($preference );
      //  $languages=Language::get();
         //dd("outer");
        return view('admin.feature')->with(compact('preference','page_title'));
    }
}