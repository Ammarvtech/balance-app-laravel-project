<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\FaqDescription;
use App\Language;
use App\Subscription;
use Validator;
use App\Faq;
use App\Card; 
use App\User; 
use App\UserLog; 
use App\Notification; 
use Mail;
use Image;

class SubscriptionController extends Controller
{
  ////////////<-subscription/details->\\\\\\\\\\\
  public function details(){       
    $user = Auth::user();
    ///multi language working
    $user_id = Auth::user()->id;
    $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    //end multi language task
    $subscriptions['subscriptions']=Subscription::where('user_id',$user->id)->get();
    $subscription_user=__('api.subscription_user');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$subscription_user,'data'=>$subscriptions]);
  }



  ////////////<-subscribe->\\\\\\\\\\\       
  public function subscribe(Request $request){ 
  ///multi language working
  $user_id = Auth::user()->id;
  $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
  $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
  Session::put('locale', $directory);       
  \App::setLocale(Session::get('locale'));
  //end multi language task      
  $validator = Validator::make($request->all(), [ 
  'name' => 'required', 
  'card_number' => 'required', 
  'expiry_date' => 'required', 
  'cvv' => 'required',  
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
  $data = $request->all();
  $user = Auth::user();
  $data['user_id']=$user->id;
  //dd($data);
  $cards['card']  = Subscription::create($data);
  $subscription_success=__('api.subscription_success');
  return response()->json(['status_code'=>200,'success' =>true,'message'=>$subscription_success,"data"=> $cards]); 
  }
    


  ////////////<-Cancel Subscription->\\\\\\\\\\\
  public function cancelSubscription(Request $request){ 

    ///multi language working
    $user_id = Auth::user()->id;
    $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    //end multi language task 
    $id=$request->id;     
    $subscriptions=Subscription::find($id);

    if(is_null($subscriptions)){
    $subscription_null=__('api.subscription_null');
    return response()->json(['status_code'=>400,'success' =>false,'message'=>$subscription_null]); 

    }

    $subscriptions->delete();
    $subscription_canceled=__('api.subscription_canceled');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$subscription_canceled]);

      
  }


  ////////////<-add/card->\\\\\\\\\\\
  public function addCard(Request $request){   
    ///multi language working
    $user_id = Auth::user()->id;
    $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    //end multi language task    
    $validator = Validator::make($request->all(), [ 
        'name' => 'required', 
        'card_number' => 'required', 
        'expiry_date' => 'required', 
        'cvv' => 'required', 
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
    $data = $request->all();
    $user = Auth::user();
    $data['user_id']=$user->id;
    //dd($data);
    $cards['card']  = Card::create($data);

    $subscription_card_success=__('api.subscription_card_success');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$subscription_card_success,"data"=> $cards]); 
  }


  ////////////<-card/lists->\\\\\\\\\\\
  public function viewCards(){
    ///multi language working
    $user_id = Auth::user()->id;
    $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    //end multi language task
    $user = Auth::user();
    $cards['cards']=Card::where('user_id',$user->id)->get();
    $subscription_cards=__('api.subscription_cards');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$subscription_cards,'data'=>$cards]); 
  } 
}
