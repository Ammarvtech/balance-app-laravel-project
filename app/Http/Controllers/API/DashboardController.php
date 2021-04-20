<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\FaqDescription;
use App\Language;
use App\Category;
use App\Transaction;
use App\CategoryDescription;
use Validator;
use App\Faq;
use App\User; 
use App\UserLog; 
use App\Notification; 
use Mail;
use Image;

class DashboardController extends Controller
{


    ////////////<-User-Info->\\\\\\\\\\\
    public function details(Request $request) 
    { 

     
        ///multi language working
        $user_id =  Auth::user()->id;
        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
        Session::put('locale', $directory);       
        \App::setLocale(Session::get('locale'));
        //end multi language task

        $array= array();
        ///user information
        $data['users'] =  Auth::user();
        if($data['users'] ==  NULL){
            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Please Login!"]);
        }
        //notifications
        $notification=Notification::where('user_id',$data['users']['id'])->where('is_read','0')->first();
        if($notification ==  NULL){
            $data['users']['is_read']=0;
        }else{
            $data['users']['is_read']=1;
        }
        $user_id = Auth::user()->id;

        ////check for =>is_bankAccountLinked
        $user = UserLog::where('user_id',$user_id)->where('type','primary')->first();
        if($user != null){
            $data['users']['bank_name']=$user['bank_name'];
            $data['users']['type']=$user['type'];
            $user_secret=$user['userSecret'];
            $bank_name=$user['bank_name'];
           
            if($bank_name == null){

               $dashboard_bank_null=__('api.dashboard_bank_null');
               return response()->json(['status_code'=>400,'success' =>false,'message'=>$dashboard_bank_null, 'data'=>$data]);
            }
            $array['userSecret'] = $user->userSecret;
                $access_token = $user->accessToken;
                $array['sync'] = "true";
                $url = 'https://api.dapi.co/v1/data/accounts/get';
                $response = $this->getDapiData($array, $url, $access_token);
                $array['accountID'] =  $response['accounts'][0]['id'];
                
                ///dapi get ballance\\\\
                $url = 'https://api.dapi.co/v1/data/balance/get';
                $response = $this->getDapiData($array, $url, $access_token);
                $data['account']['balance'] = $response['balance']['amount'];
                $data['account']['currency'] = $response['balance']['currency']['code'];
            if($user_secret == null){
               $dashboard_transaction_null=__('api.dashboard_transaction_null');
               return response()->json(['status_code'=>400,'success' =>false,'message'=>$dashboard_transaction_null, 'data'=>$data]);
            }
            
            $fromDate =$request->fromDate;
            $toDate   =$request->toDate;
            $transactions=Transaction::where('user_id',$user_id)->where('user_secret',$user_secret)->whereBetween('date',[$fromDate,$toDate])->get();
            //dd($transactions);
                          
                
            $transaction_data = array();
            $categories = array();
            $lang=User::where('id',$user_id)->pluck('language')->first();
            $lang_id=Language::where('name',$lang)->pluck('language_id')->first();
            $categories_data= DB::table('category')
                ->select('category.id','category_description.title')
                ->join('category_description','category_description.category_id','=','category.id')
                ->where('language_id','=',$lang_id)
                ->where('user_id',$user_id)
                ->get();
            $result = json_decode($categories_data, true);
            foreach($result as $key => $value){           
                    $categories[]= $value;      
            } 
            $data['categories']=$categories;
            foreach($transactions as $key => $value){
                // if($value['type'] == 'debit'){
                unset($value['user_secret']);
                $transaction_data[] = $value;
                // }
            } 
            
            $data['users']['is_bankAccountLinked']=true;
            $data['transactions'] = $transaction_data;
            
           
            
            // $array['userSecret'] = $user->userSecret;
            // $access_token = $user->accessToken;
            // $array['sync'] = "true";
            // $url = 'https://api.dapi.co/v1/data/accounts/get';
            // $response = $this->getDapiData($array, $url, $access_token);
            // $array['accountID'] =  $response['accounts'][0]['id'];
            
            // ///dapi get ballance\\\\
            // $url = 'https://api.dapi.co/v1/data/balance/get';
            // $response = $this->getDapiData($array, $url, $access_token);
            // $data['account']['balance'] = $response['balance']['amount'];
            // $data['account']['currency'] = $response['balance']['currency']['code'];
        
            // $array['fromDate'] = $request->fromDate;
            // $array['toDate'] = $request->toDate;
            // $url = "https://api.dapi.co/v1/data/transactions/get";    
            // $transactions = $this->getDapiData($array, $url, $access_token);
           
            $dashboard_user_detail=__('api.dashboard_user_detail');      
            return response()->json(['status_code'=>200,'success' =>true,'message'=>$dashboard_user_detail,'data'=>$data]); 
        }
            $data['users']['is_bankAccountLinked']=false;
            $dashboard_bank_link=__('api.dashboard_bank_link');
            return response()->json(['status_code'=>400,'success' =>false,'message'=>$dashboard_bank_link,'data'=>$data]);


    } 


    ////////////<-Expenses[categories]->\\\\\\\\\\\
    public function expenses(Request $request){ 

        ///multi language working
        $user_id =  Auth::user()->id;
        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
        Session::put('locale', $directory);       
        \App::setLocale(Session::get('locale'));
        //end multi language task


        $users =  Auth::user();
        if($users ==  NULL){
            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Please login!"]);
        }
       
        //dapi get account\\\\\\\
        $user_id = Auth::user()->id;
        $user = UserLog::where('user_id',$user_id)->first();
        $array['userSecret'] = $user->userSecret;
        $access_token = $user->accessToken;
        $array['sync'] = "true";
        $url = 'https://api.dapi.co/v1/data/accounts/get';
        $response = $this->getDapiData($array, $url, $access_token);
        $account_id =  $response['accounts'][0]['id'];
        //dd($account_id );
        
        ///dapi get ballance\\\\
        $array['accountID'] = $account_id;
        $array['fromDate'] = $request->fromDate;
        $array['toDate'] = $request->toDate;
        $url = "https://api.dapi.co/v1/data/transactions/get";    
        $transactions = $this->getDapiData($array, $url, $access_token);
       // dd($transactions);
            
        //$transactions['transactions']);
                            
        $dashboard_expenses=__('api.dashboard_expenses');                   
        return response()->json(['status_code'=>200,'success' =>true,'message'=>$dashboard_expenses,'data'=>$transactions]); 
    }
    
    public function getDapiData($array, $url, $access_token){
        $array['appSecret'] = config('services.dapi.appSecret');
            $response = Curl::to($url)
                ->withData($array)
                ->withBearer($access_token)
                ->withContentType('application/json')
                ->asJson( true )
                ->post();
           //$array['accountID'] =$account['accounts'][0]['id'];
            return $response;
        
    }

    ////////////<-Wallet-Data->\\\\\\\\\\\
    public function walletData(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['user'] = $user; 
            return response()->json(['status_code'=>200,'success' =>true,'message'=>"Successfully login!","data"=> $success]);
        } 
        else{ 
            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Email or password incorrect!"]);
        } 
    }


    ////////////<-EXPENSES->\\\\\\\\\\\
    // public function expenses(){ 
    //     if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
    //         $user = Auth::user(); 
    //         $success['token'] =  $user->createToken('MyApp')->accessToken; 
    //         $success['user'] = $user; 
    //         return response()->json(['status_code'=>200,'success' =>true,'message'=>"Successfully login!","data"=> $success]);
    //     } 
    //     else{ 
    //         return response()->json(['status_code'=>400,'success' =>false,'message'=>"Email or password incorrect!"]);
    //     } 
    // }



    ////////////<-Categoris-Show->\\\\\\\\\\\
    public function categoriesShow(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['user'] = $user; 
            return response()->json(['status_code'=>200,'success' =>true,'message'=>"Successfully login!","data"=> $success]);
        } 
        else{ 
            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Email or password incorrect!"]);
        } 
    }



    ////////////<-Category-Store->\\\\\\\\\\\
    public function CategoryStore(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            $success['user'] = $user; 
            return response()->json(['status_code'=>200,'success' =>true,'message'=>"Successfully login!","data"=> $success]);
        } 
        else{ 
            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Email or password incorrect!"]);
        } 
    }
    

    ///notifications
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function notificationsHome()
    {
        //dd("hgere");
        return view('notification');
    }

    /** 
     * Write code on Method
     *
     * @return response()
     */
        public function saveToken(Request $request)
        {
            auth()->user()->update(['device_token'=>$request->device_token]);
            $user_id=  Auth::user()->id;
            $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
            $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
            Session::put('locale', $directory);       
            \App::setLocale(Session::get('locale'));
            $data['device_token']=User::where('id',$user_id)->pluck('device_token')->first();

            $dashboard_notificaion=__('api.dashboard_notificaion');
            return response()->json(['status_code'=>200,'success' =>true,'message'=>$dashboard_notificaion,"data"=> $data]);

        }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendNotification(Request $request)
    {
        
        $user_id =  Auth::user()->id;
        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
        Session::put('locale', $directory);       
        \App::setLocale(Session::get('locale'));
        //notification
        $user_id = $user_id;
        $title = $request->title;
        $body = $request->body;
        $notification_type=($notification_type ?? "general notification");
        $response=getNotification($title,$body,$user_id,$notification_type);

        $dashboard_notificaion=__('api.dashboard_notificaion');
        return response()->json(['status_code'=>200,'success' =>true,'message'=>$dashboard_notificaion,"data"=> $response]);
        
    }

}
