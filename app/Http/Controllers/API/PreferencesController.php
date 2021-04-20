<?php



namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth; 

use Illuminate\Http\Request;

use App\Language;

use Validator;

use App\PreferenceDescription;

use Illuminate\Support\Facades\DB;

class PreferencesController extends Controller

{

  public $successStatus = 200;

  ////////////All View \\\\\\\\\\\\\\\\
  public function index()S
  {
    $user_id=  Auth::user()->id;
    $language=(DB::table('users')->where('id',$user_id)->pluck('language')->first() ?? "English");
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    $preference['preference']= DB::table('preferences')
    ->select('preferences.*','preferences_descriptions.*')
    ->join('preferences_descriptions','preferences_descriptions.preference_id','=','preferences.id')
    ->get();
    // $preference = json_decode(json_encode($preference));
    $preferences_detail=__('api.preferences_detail');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$preferences_detail,"data"=> $preference]);S
  }

    

  //////////// View faqs By Languages\\\\\\\\\\\\\\\\
  public function allPreferences($language)
  {
    $lang_id=Language::where('name',$language)->pluck('language_id')->first();
    $directory = DB::table('language')->where('language_id',$lang_id)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    $preference['preference']= DB::table('preferences')
    ->select('preferences.*','preferences_descriptions.*')
    ->join('preferences_descriptions','preferences_descriptions.preference_id','=','preferences.id')
    ->where('language_id','=',$lang_id)
    ->get();
    // $preference = json_decode(json_encode($preference));
    $preferences_detail=__('api.preferences_detail');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$preferences_detail,"data"=> $preference]);
  }

    

  //Languages
  public function languages()
  {
    $user_id=  Auth::user()->id;
    $language=(DB::table('users')->where('id',$user_id)->pluck('language')->first() ?? "English");
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    $languages['languages']= DB::table('language')
    ->get();
    // $preference = json_decode(json_encode($preference));
    $languages_detail=__('api.languages_detail');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$languages_detail,"data"=> $languages]);
  }

    

    //////////// View faqs By Languages\\\\\\\\\\\\\\\\

  public function languagesId($language)
  {
    $language=($language ?? "English");
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    $languages['languages']= DB::table('language')->where('name',$language)
    ->get();
    // $preference = json_decode(json_encode($preference));
    $languages_detail=__('api.languages_detail');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$languages_detail,"data"=> $languages]);
  }

    

    //////////// Languages Store\\\\\\\\\\\\\\\\

  public function store(Request $request) 
  { 
    $user_id=  Auth::user()->id;
    $language=(DB::table('users')->where('id',$user_id)->pluck('language')->first() ?? "English");
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    $validator = Validator::make($request->all(), [ 

        'name' => 'required', 

        'directory' => 'required', 
    ]);

    if ($validator->fails()) {
        $errors = $validator->errors();
        $message = "";
        foreach ($errors->toArray() as $key => $value) {
             $message.= $value[0]."\n";
         }
        $message = rtrim($message, "\n");         
        return response()->json(['status_code'=>400,'success' =>false,'message'=>$message]);            
    }
        $data=$request->all();
        //dd($data);
        $languages['language']  = Language::create($data); 
    $language_stored=__('api.language_stored');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$language_stored,"data"=> $languages]);
  }


  public function delete(Request $request){
    $user_id=  Auth::user()->id;
    $language=(DB::table('users')->where('id',$user_id)->pluck('language')->first() ?? "English");
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));

    $data=$request->all();
     $language_id= DB::table('language')->where('name',$data['name'])
    ->pluck('language_id')->first();
    //dd($languages);
    if(is_null($language_id)){
      $language_null=__('api.language_null');
      return response()->json(['status_code'=>400,'success' =>false,'message'=>$language_null]);
    }
    $language=Language::where('language_id',$language_id);
    $language->delete();
    $language_dell=__('api.language_dell');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$language_dell]);
  }
}

