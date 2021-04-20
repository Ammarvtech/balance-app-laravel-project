<?php

namespace App\Http\Controllers;

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



class ProjectController extends Controller

{

    ////////////<-User-Info->\\\\\\\\\\\

    public function details(Request $request) 
    { 

    $user_log = UserLog::all();

    //dd($user_log['user_id']);
    $transaction_array=array();
    $array= array();
    if($user_log != NULL){
        foreach ($user_log as $key => $value) {
          $user_id=$value['user_id'];
          $user=$value;
          $array['userSecret'] = $user->userSecret;
          $access_token = $user->accessToken;
          $array['sync'] = "true";
          ///here we will be get, account_id\\\\\\\
          $url = 'https://api.dapi.co/v1/data/accounts/get';
          $response = $this->getDapiData($array, $url, $access_token);
          if($response['success'] == true){
            // dd("her");
            $array['accountID'] =  $response['accounts'][0]['id'];
            //  dd($array['accountID']);
            $url = 'https://api.dapi.co/v1/data/balance/get';
            /////Here, we will be get all transactions details\\\\\\\
            $response = $this->getDapiData($array, $url, $access_token);
            $array['fromDate'] = date('Y-m-d', strtotime('-1 day'));
            $array['toDate'] = date("Y-m-d");
            $url = "https://api.dapi.co/v1/data/transactions/get";    
            $transactions= $this->getDapiData($array, $url, $access_token);
            //dd($transactions);
            ////Transaction saving process\\\\\\\\\\\
                foreach ($transactions['transactions'] as $key => $value) {
                    dd($value);
                    $transaction_array[]=$value;
                    $transaction_array['user_id']=$user_id;
                    $transaction_array['amount']=$value['amount'];
                    $transaction_array['description']=($value['description'] ?? "");
                    $transaction_array['details']=($value['details'] ?? "");
                    $transaction_array['date']=$value['date'];
                    $transaction_array['type']=$value['type'];
                    unset($transaction_array['currency']);
                    $transaction_array['beforeAmount']=($value['beforeAmount'] ?? "98");
                    $transaction_array['afterAmount']=($value['afterAmount'] ?? "987");
                    /// that's check for , save us from.
                    if($value['description'] == "SALARY" || $value['description' == "BONUS"] || $value['details'] == "SALARY" || $value['details' == "BONUS"]){
                        if(Transaction::where('user_id', $user_id)->where('amount',$value['amount'])->where('date',$value['date'])->exists()){
                            if(Transaction::where('user_id', $user_id)->where('amount',$value['amount'])->where('date',$value['date'])->exists()){
                            } else {
                                Transaction::create($transaction_array);
                            } 
                        } 

                    }else{
                        if(Temp::where('user_id', $user_id)->where('amount',$value['amount'])->where('date',$value['date'])->exists()){
                        } 
                        else {
                        Temp::create($transaction_array);
                        } 

                    } 
                }        
            }
        }
    }
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




}