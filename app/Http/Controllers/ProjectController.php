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
    public function test() 
    {  

     ///users record:
            $transactions=Transaction::get();
            if(is_null($transactions)){

            }else{
                foreach ($transactions as $key => $value) {
                    $user_id=$value['user_id'];
                    $data['name']=User::where('id',$user_id)->pluck('name')->get();
                    $date['email']=User::where('id',$user_id)->pluck('email')->get();

                    if(is_null($data['name'])){

                    }elseif(is_null($date['email']){

                    }else{

                        ////////////////////////////Out flow data\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                        $outFlowData = Transaction::where('user_id',$user_id)->where('created_at',date("Y-m-d"))->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))->where('type','debit')->get();
                        //  dd($transactions);
                        $outflow = 0;
                        foreach ($outFlowData as $key => $value) {
                        $outflow += $value['amount'];
                        }
                        // $data['outflow']=$outflow;
                        $data['wallet']['inflow/outflow']=($inflow ?? "0") - ($outflow ?? "0");


                        ////////////////////////////salary work\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                        $salaryData = Transaction::where('user_id',$user_id)->where('created_at',date("Y-m-d"))->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))->where('transaction_type','salary')->get();
                        $salary = 0;
                        foreach ($salaryData as $key => $value) {
                        $salary += $value['amount'];
                        }        
                        $data['wallet']['salary']=$salary ?? "";

                        ////////////////////////////Bonus work\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                        $bounusData = Transaction::where('user_id',$user_id)->where('created_at',date("Y-m-d"))->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))->where('transaction_type','bonus')->get();
                        $bonus = 0;
                        foreach ($bounusData as $key => $value) {
                        $bonus += $value['amount'];
                        }

                        $data['wallet']['bonus']=$bonus ?? "";
                        $data['wallet']['Remaining Cash']=($inflow ?? "0") - ($outflow ?? "0");


                        //Income
                        $bounusData = Transaction::where('user_id',$user_id)->where('created_at',date("Y-m-d"))->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))->where('type','credit')->get();
                        $income = 0;
                        foreach ($bounusData as $key => $value) {
                        $income += $value['amount'];
                        }
                        $data['income']['income']=$income ?? "";

                        //expense
                        $bounusData = Transaction::where('user_id',$user_id)->where('created_at',date("Y-m-d"))->whereMonth('created_at', date('m'))
                        ->whereYear('created_at', date('Y'))->where('type','debit')->get();
                        $expense = 0;
                        foreach ($bounusData as $key => $value) {
                        $expense += $value['amount'];
                        }
                        $data['expenses']['expenses']=$expense ?? "";


                        //mail process
                        $data['subject']="Balance App's Daily report";
                        Mail::to($data['to_email'])->send(new DailyEmail($data));


                        dd('flash_message_success','Mail has been added successfully!');
                    }
                    

                }
              }




    }

    ////////////<-User-Info->\\\\\\\\\\\

    public function details(Request $request) 
    { 

      //////////get transactions "3 times" daily\\\\\\\\\\\\\\\\ 
      $user_log = UserLog::all();

      //dd($user_log['user_id']);
      $transaction_array=array();
      $array= array();
      if($user_log != NULL){
        set_time_limit(300);
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
              ///dd($value);
              $transaction_array[]=$value;
              $transaction_array['user_id']=$user_id;
              $transaction_array['amount']=$value['amount'];
              $transaction_array['description']=($value['description'] ?? "");
              $transaction_array['details']=($value['details'] ?? "bonus");
              $transaction_array['date']=$value['date'];
              $transaction_array['type']=$value['type'];
              unset($transaction_array['currency']);
              $transaction_array['beforeAmount']=($value['beforeAmount'] ?? "98");
              $transaction_array['afterAmount']=($value['afterAmount'] ?? "987");
              /// that's check for , save us from.
              $s_des_pos = strpos( $transaction_array['description'], "salary");
              $b_des_pos = strpos( $transaction_array['description'], "bonus");
              $s_detail_pos = strpos( $transaction_array['details'], "salary");
              $b_detail_pos = strpos( $transaction_array['details'], "bonus");


              if($s_des_pos !== false || $s_detail_pos !== false){
                if(Transaction::where('user_id', $user_id)->where('amount',$value['amount'])->where('date',$value['date'])->exists()){
                }else{ 
                   $transaction_array['transaction_type']="salary";
                   $result=Transaction::create($transaction_array);
                   //notification
                   $user_id=$user_id;
                   $title="Did you add salary yet?";
                   $body="Hi, your salary have been added!.";
                   getNotification($title,$body,$user_id);
                   dd($result); 
                }
                
              } elseif ($b_des_pos !== false || $b_detail_pos !== false){
                if(Transaction::where('user_id', $user_id)->where('amount',$value['amount'])->where('date',$value['date'])->exists()){
                }else{ 
                    $transaction_array['transaction_type']="bonus";
                    $res=Transaction::create($transaction_array);
                    //notification
                    $user_id=$user_id;
                    $title="Did you add bounus yet?";
                    $body="Hi, your bounus have been added!.";
                    getNotification($title,$body,$user_id);
                    dd($res);
                }
              } else{
                if(Temp::where('user_id', $user_id)->where('amount',$value['amount'])->where('date',$value['date'])->exists()){
                }else{
                    Temp::create($transaction_array);
                    //notification
                    $user_id=$user_id;
                    $title="New Transactions";
                    $body="Hi, please find below list of new transactions made today.";
                    getNotification($title,$body,$user_id);
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