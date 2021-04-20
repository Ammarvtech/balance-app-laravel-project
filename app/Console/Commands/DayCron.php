<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Card;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Str;
use App\Language;
use App\Transaction;
use App\User; 
use App\Temp; 
use App\UserLog;
class DayCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '3 Times, daily, transaction data collection';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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
                $userSecret=($array['userSecret'] ?? "");
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
                    $transaction_array['details']=($value['details'] ?? "");
                    $transaction_array['date']=$value['date'];
                    $transaction_array['type']=$value['type'];
                    $transaction_array['user_seceret']=$userSecret;
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
                         $notification_type="salary";
                         getNotification($title,$body,$user_id,$notification_type);
                         //dd($result); 
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
                          $notification_type="bounus";
                          getNotification($title,$body,$user_id,$notification_type);
                          //dd($res);
                      }
                    } else{
                      if(Temp::where('user_id', $user_id)->where('amount',$value['amount'])->where('date',$value['date'])->exists()){
                      }else{
                          Temp::create($transaction_array);
                          //notification
                          $user_id=$user_id;
                          $title="New Transactions";
                          $body="Hi, please find below list of new transactions made today.";
                          $notification_type="transaction";
                          getNotification($title,$body,$user_id,$notification_type);
                      }
                      
                    }
                                           
                  } 
                }        
              }
            }

           ///That's given below, just for testing\\\\\\\\\\\ 
           
           // $card = array(
           //        'user_id' => "43",
           //        'name' =>"final testing",
           //        'card_number' =>"7899708",
           //        'expiry_date' =>"2020-10-19",
           //        'cvv' =>"453"
           // );
           // Card::create($card);


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


    //notification private message
}
