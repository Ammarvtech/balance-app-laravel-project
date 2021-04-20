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

use App\Transaction;

use App\TransactionImage;

use Validator;

use App\Faq;
use App\Temp;

use App\User; 

use App\UserLog; 

use App\Notification; 

use Mail;

use Image;



class TranslationController extends Controller

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
            
            //dapi get account\\\\\\\
            $user = UserLog::where('user_id',$user_id)->first();

            $array['userSecret'] = $user->userSecret;

            $access_token = $user->accessToken;

            $array['sync'] = "true";

            $url = 'https://api.dapi.co/v1/data/accounts/get';

            $response = $this->getDapiData($array, $url, $access_token);

            $array['accountID'] =  $response['accounts'][0]['id'];

            

            ///dapi get account_id\\\\

            $url = 'https://api.dapi.co/v1/data/balance/get';

            $response = $this->getDapiData($array, $url, $access_token);

            ///dapi get transactions details\\

            $array['fromDate'] = $request->fromDate;

            $array['toDate'] = $request->toDate;

            $url = "https://api.dapi.co/v1/data/transactions/get";    

            $transactions= $this->getDapiData($array, $url, $access_token);

            $data['transactions']=array($transactions);
            $transactions_details=__('api.transactions_details');
            return response()->json(['status_code'=>200,'success' =>true,'message'=>$transactions_details,'data'=>$data]); 

        } 

      







        ////////////<-Transaction Details->\\\\\\\\\\\

        public function transactionDetails(Request $request) 

        { 

            ///multi language working
            $user_id =  Auth::user()->id;
            $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
            $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
            Session::put('locale', $directory);       
            \App::setLocale(Session::get('locale'));
            //end multi language task
            
            //dapi get account\\\\\\\
            $transactions = Transaction::where('user_id',$user_id);

            if($transactions == ""){
                $transactions_null=__('api.transactions_null');
                return response()->json(['status_code'=>400,'success' =>false,'message'=>$transactions_null]);

            }

            

            $transactions=Transaction::where('user_id',$user_id)->get();

            $data['transactions']=array($transactions);


            $transactions_details=__('api.transactions_details');
            return response()->json(['status_code'=>200,'success' =>true,'message'=>$transactions_details,'data'=>$data]); 

        } 


        ////////////<-Transaction Details->\\\\\\\\\\\                

        public function tempDetails(Request $request) 

        { 
         
            ///multi language working
            $user_id =  Auth::user()->id;
            $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
            $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
            Session::put('locale', $directory);       
            \App::setLocale(Session::get('locale'));
            //end multi language task


            //dapi get account\\\\\\\
            $transactions = Temp::where('user_id',$user_id);

            if($transactions == ""){
                $transactions_details=__('api.transactions');    
                return response()->json(['status_code'=>400,'success' =>false,'message'=>"Temp data, have no data!"]);

            }  

            $transactions=Temp::where('user_id',$user_id)->get();

            $data['temp_transactions']=array($transactions);
            $temp_transactions_details=__('api.temp_transactions_details');
            return response()->json(['status_code'=>200,'success' =>true,'message'=>$temp_transactions_details,'data'=>$data]); 

        } 

        ////////////<-Save-Translation->\\\\\\\\\\\
        public function tempDetailsUpdate(Request $request){ 
         
           ///multi language working
           $user_id =  Auth::user()->id;
           $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
           $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
           Session::put('locale', $directory);       
           \App::setLocale(Session::get('locale'));
           //end multi language task
            
            $data = $request->json()->all();
            $temp=$data['temp_transactions'];
            $transaction_array = array();
            //$coun=count($data['temp_transactions']['id']);
            //dd($temp);

            foreach ($temp as $key => $value) {
                $transaction_array['user_id']=$value['user_id'];
                $transaction_array['amount']=$value['amount'];
                $transaction_array['category']=$value['category'];
                $transaction_array['date']=$value['date'];
                $transaction_array['description']=$value['description'];
                $transaction_array['type']=$value['type'];
                $transaction_array['note']=$value['note'];
                $transaction_array['beforeAmount']=$value['beforeAmount'];
                $transaction_array['afterAmount']=$value['afterAmount'];

                //temp transaction deletion
                $temp=Temp::find($value['id']);
                if(is_null($temp)){
                   
                }else{
                   $temp->delete();
                   //new transaction creation
                   $resultTemp=Transaction::create($transaction_array);
                }        


            }
            $tansaction_success=__('api.tansaction_success');
            return response()->json(['status_code'=>200,'success' =>true,'message'=>$tansaction_success]); 
        }

        
        ////////////<-Transaction Details->\\\\\\\\\\\                
        public function reports(Request $request) 
        { 

            ///multi language working
            $user_id =  Auth::user()->id;
            $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
            $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
            Session::put('locale', $directory);       
            \App::setLocale(Session::get('locale'));
            //end multi language task

            //dapi get account\\\\\\\
            $transactions = Transaction::where('user_id',$user_id);

            if($transactions == ""){
                $transactions_empty=__('api.transactions_empty');
                return response()->json(['status_code'=>400,'success' =>false,'message'=>$transactions_empty]);

            }  
            $data=$request->all();
            $transactions = Transaction::where('date',[$data['fromDate'],$data['toDate']])->where('type','credit')->get();
            $data['reports']=array($transactions);
            $temp_transactions_details=__('api.temp_transactions_details');
            return response()->json(['status_code'=>200,'success' =>true,'message'=>$temp_transactions_details,'data'=>$data]); 

        } 


        ////////////<-Transaction Delete->\\\\\\\\\\\

        public function transactionDelete(Request $request) 

        { 
            ///multi language working
            $user_id =  Auth::user()->id;
            $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
            $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
            Session::put('locale', $directory);       
            \App::setLocale(Session::get('locale'));
            //end multi language task

            $id=$request->id;

            $result=Transaction::find($id);

            if(is_null($result)){
                $transactions_empty=__('api.transactions_empty');
                return response()->json(['status_code'=>400,'success' =>false,'message'=>$transactions_empty]);

            }

            $result->delete();
            $transactions_dell=__('api.transactions_dell');
            return response()->json(['status_code'=>200,'success' =>true,'message'=>$transactions_dell]); 

        } 



    ////////////<-Update->\\\\\\\\\\\

    public function update(){       

        return response()->json(['status_code'=>200,'success' =>true,'message'=>"Update api Under process!","data"=> "Still Empty"]); 

    }



    ////////////<-delete->\\\\\\\\\\\

    public function delete(){       

        return response()->json(['status_code'=>200,'success' =>true,'message'=>"Delete api Under process!","data"=> "Still Empty"]); 

    }

    ////Resonsive private function

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

    

     ////////////<-Labels by language->\\\\\\\\\\\

    public function labelsName($language){   

    //locale

    $directory = DB::table('language')->where('directory',$language)->pluck('directory')->first();

    if($directory ==  ""){

    return response()->json(['status_code'=>400,'success' =>false,'message'=>"Data not available against this language!"]);

    }

     

     Session::put('locale', $directory);       

    \App::setLocale(Session::get('locale'));

    dd(__('api.balance'));

    Session::put('locale', $directory);       

    \App::setLocale(Session::get('locale'));

    

    

    return response()->json(['status_code'=>200,'success' =>true,'message'=>"Label api Under process!","data"=> "Still Empty"]); 

    }

    

     ////////////<-All labels->\\\\\\\\\\\

    public function labels(){ 

        $user_id = Auth::user()->id;

        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();

        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();

        Session::put('locale', $directory);       

        \App::setLocale(Session::get('locale'));

        $labels['labels']['balance']= __('api.balance');

        $labels['labels']['track_your_spend']=__('api.track_your_spend');

        $labels['labels']['track_your_spend_description']=__('api.track_your_spend_description');

        $labels['labels']['signup']=__('api.signup');

        $labels['labels']['full_name']=__('api.full_name');

        $labels['labels']['email']=__('api.email'); 

        $labels['labels']['password']=__('api.password');

        $labels['labels']['login']=__('api.login');

        $labels['labels']['send']= __('api.send');

        $labels['labels']['message']=__('api.message');

        $labels['labels']['skip']=__('api.skip'); 

        $labels['labels']['verify']= __('api.verify');

        $labels['labels']['verify_description']= __('api.verify_description'); 

        $labels['labels']['forget_password']= __('api.forget_password' );

        $labels['labels']['forget_password_description']= __('api.forget_password_description');

        $labels['labels']['verify_process']=__('api.verify_process');

        $labels['labels']['dashboard']= __('api.dashboard');

        $labels['labels']['balance']= __('api.balance');

        $labels['labels']['expenses']= __('api.expenses');

        $labels['labels']['report']=__('api.report');

        $labels['labels']['daily']=__('api.daily');

        $labels['labels']['weekly']=__('api.weekly');

        $labels['labels']['monthly']= __('api.monthly');

        $labels['labels']['home']= __('api.home');

        $labels['labels']['wallet']= __('api.wallet');

        $labels['labels']['settings']= __('api.settings');

        $labels['labels']['tracking_cash_inflowOutflow']= __('api.tracking_cash_inflowOutflow');

        $labels['labels']['salary']=__('api.salary');

        $labels['labels']['bonus']= __('api.bonus');

        $labels['labels']['remaining_Cash']= __('api.remaining_Cash');

        $labels['labels']['income']= __('api.income');

        $labels['labels']['transactions']= __('api.transactions');

        $labels['labels']['add_new']= __('api.add_new');

        $labels['labels']['transactions']= __('api.transactions');

        $labels['labels']['profile']= __('api.profile');

        $labels['labels']['subscriptions']= __('api.subscriptions');

        $labels['labels']['privacy_policy']= __('api.privacy_policy');

        $labels['labels']['logout']= __('api.logout');

        $labels['labels']['salery_description']= __('api.salery_description');

        $labels['labels']['language']= __('api.language' );

        $labels['labels']['curency']= __('api.curency');

        $labels['labels']['language']= __('api.language');

        $labels['labels']['budget_limit']= __('api.budget_limit');

        $labels['labels']['two_factor_authentication']= __('api.two_factor_authentication');

        $labels['labels']['email_report_frequeny']= __('api.email_report_frequeny');

        $labels['labels']['contact']= __('api.contact');

        $labels['labels']['delete_transaction']= __('api.delete_transaction');

        $labels['labels']['confirm_charges']= __('api.confirm_charges');

        $labels['labels']['charge_description']= __('api.charge_description');

        $labels['labels']['save_transaction']= __('api.save_transaction');

        $labels['labels']['cancel']= __('api.cancel');

        $labels['labels']['confirm']= __('api.confirm');

        $labels['labels']['confirm_description']= __('api.confirm_description');

        $labels['labels']['location_goes_here']= __('api.location_goes_here');

        $labels['labels']['budgetis_exceeded']= __('api.budgetis_exceeded');

        $labels['labels']['budgetis_exceeded_description']= __('api.budgetis_exceeded_description');

        $labels['labels']['add_salery_yet']= __('api.add_salery_yet');

        $labels['labels']['add_salery_yet_description']= __('api.add_salery_yet_description');

        $labels['labels']['charge_detected']= __('api.charge_detected');

        $labels['labels']['charge_detected_description']= __('api.charge_detected_description');

        $labels['labels']['go_premium']= __('api.go_premium');

        $labels['labels']['subscription_description']= __('api.subscription_description');

        //dd( $labels['track_your_spend_description']);
        $labels_details=__('api.labels_details');
        return response()->json(['status_code'=>200,'success' =>true,'message'=>$labels_details,"data"=> $labels]);

        }

}

