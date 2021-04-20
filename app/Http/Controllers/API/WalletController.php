<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Wallet;
use App\Language;
use App\Category;
use App\CategoryDescription;
use Validator;
use App\Faq;
use App\Transaction;
use App\User; 
use App\UserLog; 
use App\Notification; 
use Mail;
use Image;

class WalletController extends Controller
{


    ////////////<-User-Info->\\\\\\\\\\\
    public function walletDetails(Request $request) 
    { 


        ///multi language working
        $user_id =  Auth::user()->id;
        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
        Session::put('locale', $directory);       
        \App::setLocale(Session::get('locale'));
        //end multi language task

        
        //dapi get account\\\\\\\
        $user = UserLog::where('user_id',$user_id)->where('type','primary')->first();
        $transactions = Transaction::where('user_id',$user_id)->where('user_secret',$user['userSecret']);
        if($transactions == ""){
            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Temp data, have no data!"]);
        }  
        $data=$request->all();
        ////////////////////////////in flow data\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        $inflowData=Transaction::where('user_id',$user_id)->whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))->where('type','credit')->get();
        $inflow=0;
        foreach ($inflowData as $key => $value) {
            $inflow +=$value['amount'];
        }
       // $data['inflow']=$inflow;

        

        ////////////////////////////Out flow data\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        $outFlowData = Transaction::where('user_id',$user_id)->whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))->where('type','debit')->get();
        //  dd($transactions);
        $outflow = 0;
        foreach ($outFlowData as $key => $value) {
            $outflow += $value['amount'];
        }
       // $data['outflow']=$outflow;
        $data['wallet']['inflow/outflow']=($inflow ?? "0") - ($outflow ?? "0");


        ////////////////////////////salary work\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        $salaryData = Transaction::where('user_id',$user_id)->whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))->where('transaction_type','salary')->get();
        $salary = 0;
        foreach ($salaryData as $key => $value) {
            $salary += $value['amount'];
        }        
        $data['wallet']['salary']=$salary ?? "";

        ////////////////////////////Bonus work\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        $bounusData = Transaction::where('user_id',$user_id)->whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))->where('transaction_type','bonus')->get();
        $bonus = 0;
        foreach ($bounusData as $key => $value) {
            $bonus += $value['amount'];
        }

        $data['wallet']['bonus']=$bonus ?? "";
        // $data['wallet']['Remaining Cash']=($inflow ?? "0") - ($outflow ?? "0");




        $user = UserLog::where('user_id',$user_id)->where('type','primary')->first();
        if($user != null){
           
            $user_secret=$user['userSecret'];
            $array['userSecret'] = $user->userSecret;
                $access_token = $user->accessToken;
                $array['sync'] = "true";
                $url = 'https://api.dapi.co/v1/data/accounts/get';
                $response = $this->getDapiData($array, $url, $access_token);
                $array['accountID'] =  $response['accounts'][0]['id'];
                
                ///dapi get ballance\\\\
                $url = 'https://api.dapi.co/v1/data/balance/get';
                $response = $this->getDapiData($array, $url, $access_token);
                $data['wallet']['Remaining Cash'] = $response['balance']['amount'];
                $data['wallet']['currency'] = $response['balance']['currency']['code'];
        }
        //Income
        $incomeData = Transaction::where('user_id',$user_id)->whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))->where('type','credit')->get();
        $income  = array();
        foreach ($incomeData as $key => $value) {
            unset($value['user_secret']);
            $income[]= $value;
        }
        //$data['income']['income']=($income ?? "");
        $data['income']=($income ?? "");

        //expense
        $expenseData = Transaction::where('user_id',$user_id)->whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))->where('type','debit')->get();
        $expense  = array();
        foreach ($expenseData as $key => $value) {
            unset($value['user_secret']);
            $expense[]= $value;
        }
        //$data['expenses']['expenses']=($expense ?? "");
        $data['expenses']=($expense ?? "");
        $temp_transactions_details=__('api.temp_transactions_details');
        return response()->json(['status_code'=>200,'success' =>true,'message'=>$temp_transactions_details,'data'=>$data]); 

         
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







}
