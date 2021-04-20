<?php



namespace App\Http\Controllers\API;


use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth; 

use Illuminate\Support\Facades\DB;

use Ixudra\Curl\Facades\Curl;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\FaqDescription;

use App\Language;

use Validator;

use App\Faq;

use App\User; 

use App\UserLog; 

use App\Notification; 

use Mail;

use Image;



class SettingController extends Controller

{

	////////////<-User-Info->\\\\\\\\\\\

	public function settings(Request $request) { 

        $user =  Auth::user();

        $data['settings'] = User::getSettings($user->id);

        $user_id = $user['id'];

        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();

        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();

        Session::put('locale', $directory);       

        \App::setLocale(Session::get('locale'));
        //dd(Session::get('locale'));
       $settings= __('api.Settings_success');


        return response()->json(['status_code'=>200,'success' =>true,'message'=>$settings,'data'=>$data]);

    }



    //////////////Update Settings\\\\\\\\\\\\\\\\\\\\\  

    public function updateSettings(Request $request) { 

        $user =  Auth::user();

        $array = array($request->type => $request->value);

        User::where('id', $user->id)->update($array);  

        $data['settings'] = User::getSettings($user->id);

        //
        $user_id = $user['id'];

        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();

        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();

        Session::put('locale', $directory);       

        \App::setLocale(Session::get('locale'));
        $update= __('api.settings_update');

        return response()->json(['status_code'=>200,'success' =>true,'message'=>$update,'data'=>$data]);          

    }

    

    

}

