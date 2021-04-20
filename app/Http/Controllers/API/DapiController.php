<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ixudra\Curl\Facades\Curl;
use App\UserLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use App\User;
class DapiController extends Controller
{
  public $successStatus = 200;


  public function exchangeToken(Request $request)
  {
        $url = $request->url;
        $array =  $request->toArray();
        unset($array['url']);

      $response = Curl::to($request->url)

          ->withData($array)
          ->withContentType('application/json')

          ->asJson( true )

          ->post();

      dd($response);
  }



  public function bankAccount(Request $request)
  {
    $data= array();
    $user_id = Auth::user()->id;

    ///multi language working
    $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    //end multi language task

    $bank=UserLog::where('user_id',$user_id)->get();
    if($bank == NULL){
      $dapi_accont_null=__('api.dapi_accont_null');
      return response()->json(['status_code'=>400,'success' =>false,'message'=>$dapi_accont_null]);
    }

    $i=0;
    foreach ($bank as $key => $value) {
      $data[$i]['id']=$value['id'];
      $data[$i]['bank_name']=$value['bank_name'];
      $data[$i]['bank_icon']=$value['bank_icon'];
      $data[$i]['type']=$value['type'];
      $i++;
    }
    $result['accounts']=$data;
    $dapi_accont_detail=__('api.dapi_accont_detail');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$dapi_accont_detail, "data"=>$result]);
  }



  public function updateBankAccount(Request $request)
  {
    $data= array();
    $user_id = Auth::user()->id;
    ///multi language working
    $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
    $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
    Session::put('locale', $directory);       
    \App::setLocale(Session::get('locale'));
    //end multi language task
    $id=$request->id;
    $array = array('type' =>"normal");
    $bank=UserLog::where('user_id',$user_id)->update($array);
    unset($array);
    $array = array('type' =>"primary");
    $bank=UserLog::where('id',$id)->update($array);
    $bank=UserLog::where('user_id',$user_id)->get();
    
    $i=0;
    foreach ($bank as $key => $value) {
        $data[$i]['id']=$value['id'];
        $data[$i]['bank_name']=$value['bank_name'];
        $data[$i]['bank_icon']=$value['bank_icon'];
        $data[$i]['type']=$value['type'];
        $i++;      
    }
    $result['accounts']=$data;
    $dapi_accont_detail=__('api.dapi_accont_detail');
    return response()->json(['status_code'=>200,'success' =>true,'message'=>$dapi_accont_detail,"data"=>$result]);
  }



  public function dapiAPI(Request $request){
      $user_id = Auth::user()->id;
      ///multi language working
      $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();
      $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();
      Session::put('locale', $directory);       
      \App::setLocale(Session::get('locale'));
      //end multi language task
      $array = $request->json()->all();
      $url = $array['url'];
      $array['appSecret'] = config('services.dapi.appSecret');
     // $array['appSecret'] = "abc";
      unset($array['url']);
      if( strpos( $url, 'ExchangeToken' ) !== false){ 
          $userSecret = $array['userSecret'];
          $userSecret = $array['userSecret'];
          $bank_name = $array['bank_name'];
          $bank_icon = $array['bank_icon'] ?? "";
          unset($array['userSecret']);
          $response = Curl::to($url)

              ->withData($array)

              ->withContentType('application/json')

              ->asJson( true )

              ->post();

          if($response['success'] == true){

              $userLog = array(

                  'user_id' => $user_id,

                  'userSecret' =>$userSecret,

                  'accessCode' =>($array['accessCode'] ?? ""),

                  'connectionID' =>($array['connectionID'] ?? ""),

                  'bank_name' =>($array['bank_name'] ?? ""),
                  'bank_icon' =>($array['bank_icon'] ?? ""),
                  'type' =>"primary",
                  'is_bankAccountLinked' => 1,

                  //'accessToken' => "here"
                  'accessToken' => $response['accessToken']

              );
              $type = array('type' =>"normal");
              $bank = UserLog::where('user_id',$user_id)->update($type);

              /*$user = UserLog::where('user_id',$user_id)->first();
              if($user !=null){
                  $bank_name=UserLog::where('bank_name',$bank_name)->pluck('bank_name')->first();
                  if($bank_name !=null){
                      $response=UserLog::where('user_id', $user_id)->where('bank_name',$bank_name)->update($userLog);
                  }else{
                      $response=UserLog::create($userLog);
                  }
              }
              return response()->json(['status_code'=>200,'success' =>true,'message'=>"Bank details!",'data'=>$response]);*/
              $userData = UserLog::where('user_id',$user_id)->where('bank_name',$bank_name)->first();
              if($userData !=null){
                $response=UserLog::where('user_id', $user_id)->where('bank_name',$bank_name)->update($userLog);
                return response()->json(['status_code'=>200,'success' =>true,'message'=>"Bank details!",'data'=>$response]); 
              }else{
                $response=UserLog::create($userLog);
                $dapi_bank_detail=__('api.dapi_bank_detail');
                return response()->json(['status_code'=>200,'success' =>true,'message'=>$dapi_bank_detail,"data"=>$response]);
                //return response()->json(['status_code'=>200,'success' =>true,'message'=>"Bank details!",'data'=>$response]); 
              }
          }else{

              return response()->json(['success' =>false, "data"=> $response], $this->successStatus);

          }

      }else{

          $user = UserLog::where('user_id',$user_id)->first();

          $array['userSecret'] = $user->userSecret;

          $response = Curl::to($request->url)

              ->withData($array)

              ->withBearer($user->accessToken)

              ->withContentType('application/json')

              ->asJson( true )

              ->post();

    }

    if($response['success'] == true)
      return response()->json(['success' =>true, "data"=> $user], $this->successStatus);
      return response()->json(['success' =>false, "data"=> $response], $this->successStatus);

  }

    ///////////////***Dapi Api's [Authentication]***\\\\\\\\\\\\\\\\\\\\\\
    public function dapiAuth(){

       $response = Curl::to('https://api.blockcypher.com/v1/eth/main/addrs?token=YOURTOKEN')->post();

       dd($response);

    }
}

