<?php



namespace App\Http\Controllers\home;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use Image;



use App\Category;

use App\CategoryDescription;



use App\User;

use App\Contact;



use App\Faq;

use App\FaqDescription;



use App\Feature;

use App\FeatureTranslation;



use App\Preference;

use App\PreferenceDescription;



use App\Page;

use App\PageDescription;



use App\Slider;

use App\SliderDescription;



use App\Testimonial;

use App\TestimonialDescription;



use Illuminate\Support\Facades\DB;

use App\Language;

use App\Rules\Captcha;

use Illuminate\Support\Facades\App;



class MainController extends Controller

{

  //////////Languages\\\\\\\\

  public function language($language_id){

    $language_id = DB::table('language')->where('language_id',$language_id)->pluck('language_id')->first();

    Session::put('language_id', $language_id);



    //locale

    $directory = DB::table('language')->where('language_id',$language_id)->pluck('directory')->first();

    Session::put('locale', $directory);       

     \App::setLocale(Session::get('locale'));

  return redirect()->back();

  }



	//////////Home  Page\\\\\\\\

	public function home(Request $request)

	{

    $data['preferences']= Preference::with('preference_description')->first();

    $data['preferences_descriptions'] =  $data['preferences']->preference_description->first();

    $data['sliders']= Slider::with('slider_description')->orderBy('id', 'DESC')->first();       

    $data['features']= Feature::with('feature_description')->get();

    $data['pages']= Page::with('pages_description')->where('type','home')->get();

    return view('home.index', $data);

  }



  public function welcome(Request $request)

  {

    

    App::setlocale($request->lang);

    session()->put('locale', $request->lang);  

   

    return view('welcome');

  }



	//////////////Preferences\\\\\\\\\\

	public function preferences(Request $request)

	{

	  $categories = DB::table('category')

	    ->select('category.*','category_description.*')

	        ->join('category_description','category_description.category_id','=','category.id')

	        ->where('language_id','=',Session::get('language_id'))

	        ->get();

	  $page_title = "Categories";

	  $users=User::get();

	  return view('home.categories')->with(compact('users','categories','page_title'));

	}





	//////////About us Page\\\\\\\\

    public function aboutUs(Request $request)

    {

      

      $data['preferences']= Preference::with('preference_description')->first();

      $data['preferences_descriptions'] =  $data['preferences']->preference_description->first();

      $data['pages']= Page::with('pages_description')->where('type','aboutUs')->get();

      return view('home.about_us',$data);

    }



    //////////Safety and Security Page\\\\\\\\

    public function security(Request $request)

    {

      $data['preferences']= Preference::with('preference_description')->first();

      $data['preferences_descriptions'] =  $data['preferences']->preference_description->first();

      $data['sliders']= Slider::with('slider_description')->orderBy('id', 'DESC')->first(); 

      $data['pages']= Page::with('pages_description')->where('type','Safety')->get();      

      return view('home.security',$data);  

    }



    //////////Privacy and Policy Page\\\\\\\\

    public function privacy(Request $request)

    {



      $data['preferences']= Preference::with('preference_description')->first();

      $data['preferences_descriptions'] =  $data['preferences']->preference_description->first();

      $data['sliders']= Slider::with('slider_description')->orderBy('id', 'DESC')->first();

      $data['pages']= Page::with('pages_description')->where('type','policy')->get();      

      return view('home.privacy',$data);          

    }



    //////////Featurs  Page\\\\\\\\

    public function features(Request $request)

    {

      $data['preferences']= Preference::with('preference_description')->first();

      $data['preferences_descriptions'] =  $data['preferences']->preference_description->first();

      $data['preferences_descriptions'] =  $data['preferences']->preference_description->first();

      $data['pages']= Page::with('pages_description')->where('type','feature')->get();

      return view('home.features',$data);

    }





    //////////Customer Service  Page\\\\\\\\

    public function services(Request $request)

    {

      $data['preferences']= Preference::with('preference_description')->first();

      $data['preferences_descriptions'] =  $data['preferences']->preference_description->first();

      $data['testimonials']= Testimonial::with('testimonial_description')->orderBy('sort_order','ASC')->get(); 

      $data['faqs']= Faq::with('faq_description')->orderBy('sort_order','ASC')->get();

      //dd($data['faqs']);

      return view('home.service',$data);

    }



   

    public function categories(Request $request)

    {

      if ($request->session()->has('language_id')) {

        $categories = DB::table('category')

          ->select('category.*','category_description.*')

              ->join('category_description','category_description.category_id','=','category.id')

              ->where('language_id','=',Session::get('language_id'))

              ->get();

        $page_title = "Categories";

        $users=User::get();

        return view('home.categories')->with(compact('users','categories','page_title'));

      }

      $categories = DB::table('category')

        ->select('category.*','category_description.*')

            ->join('category_description','category_description.category_id','=','category.id')

            ->where('language_id','=',1)

            ->get();

      $page_title = "Categories";

      $users=User::get();

      return view('home.categories')->with(compact('users','categories','page_title'));

    }

    public function contacts(Request $request)

    {

     if($request->isMethod('post')){

        $data = request()->validate([

            'name' => 'required|max:120',

            'email' => 'required|email',

            'phone' => 'required|min:11|numeric',

            'message' => 'required',

            'g-recaptcha-response' => new Captcha(),

        ]);



        $data = $request->all();

        $contact = new Contact;

        $contact->name = $data['name'];

        $contact->email = $data['email'];

        $contact->phone = $data['phone'];

        $contact->message = $data['message'];

        $contact->save();

        return redirect()->back()->with('flash_message_success','Your Message have been Sent!');

      }

    }

}

