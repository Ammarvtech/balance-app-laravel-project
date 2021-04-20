<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\FaqDescription;
use App\Language;
use Validator;
use Session;
use App\Faq;
use App\User; 
use App\UserLog; 
use App\Transaction; 
use App\TransactionImage; 
use App\Notification; 
use Mail;
use Image;

class ChargeController extends Controller
{
    ////////////<-Create-Charge->\\\\\\\\\\\
    public function createCharge(){       
        return response()->json(['status_code'=>200,'success' =>true,'message'=>"Create Charge api Under process!","data"=> "Still empty data"]); 
    }

    ////////////<-Save-Translation->\\\\\\\\\\\
   public function saveTransaction(Request $request){ 
        $validator = Validator::make($request->all(), [ 
            'amount' => 'required', 
            'date' => 'required', 
            'type' => 'required', 
            'category' => 'required', 
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
        $transactionImage['user_id']=$data['user_id'];
        $transactionImage['image']=implode(",",$data['image']);
        unset($data['image']);
        
        $transaction['transaction']  = Transaction::create($data);
        $last=Transaction::latest()->first();
        //dd($last['id']);
        $transactionImage['transaction_id']=$last['id'];
        //dd($transactionImage);
        TransactionImage::create($transactionImage);
        $images = TransactionImage::where('user_id', $user->id)->where('transaction_id',$last['id'])->pluck('image');
        
        $transaction['image path'] = "";
        foreach ($images as $key => $value) {
             $transaction['image path'].= $value."\n";
        }

        $user_id = $user['id'];

        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();

        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();

        Session::put('locale', $directory);       

        \App::setLocale(Session::get('locale'));
        $charge_transaction_saved=__('api.charge_transaction_saved');
        return response()->json(['status_code'=>200,'success' =>true,'message'=>$charge_transaction_saved,"data"=> $transaction]); 
    }



    //////////////Transactions Image 
    public function transactionImage(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'image' => 'required', 
            
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
       // dd($data);
        if($request->hasFile('image')){
            $image_tmp = $request->image; //Input::file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;
                $image_path ='images/transaction/'.$filename;
                Image::make($image_tmp)->resize(300,300)->save($image_path);
                $images = $filename;
            }
        }
       
        $transaction['image_path']= url('/images/transaction/').'/'.$images;
        $user = Auth::user();
        
        $user_id = $user['id'];

        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();

        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();

        Session::put('locale', $directory);       

        \App::setLocale(Session::get('locale'));
         
        $charge_transaction_Image_saved=__('api.charge_transaction_Image_saved');
        return response()->json(['status_code'=>200,'success' =>true,'message'=>$charge_transaction_Image_saved,"data"=> $transaction]);
    }

    /////////////UPDATE PROFILE\\\\\\\\\\\\
    public function transactionImageDelete(Request $request) 
    { 

        $user = Auth::user();
        
        $user_id = $user['id'];

        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();

        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();

        Session::put('locale', $directory);       

        \App::setLocale(Session::get('locale'));
        $subject=$request->image;
        $search = 'http://balanceapp.gcc-demo.com/images/transaction/';
        $image = str_replace($search,'', $subject);
        $path='images/transaction/'.$image;
        if (File::exists($path)) {
        unlink($path);

        $charge_slip_del=__('api.charge_slip_del');
        return response()->json(['status_code'=>200,'success' =>true,'message'=>$charge_slip_del]); 
        }

        $charge_slip_empty=__('api.charge_slip_empty');
        return response()->json(['status_code'=>400,'success' =>false,'message'=>$charge_slip_empty]);
        
    } 
    
    //update transaction  
    public function transactionUpdate(Request $request) 
    { 
        $user = Auth::user();
        
        $user_id = $user['id'];

        $language=DB::table('users')->where('id',$user_id)->pluck('language')->first();

        $directory = DB::table('language')->where('name',$language)->pluck('directory')->first();

        Session::put('locale', $directory);       

        \App::setLocale(Session::get('locale'));
        $data = $request->all();
        if($data ==  NULL){
            $charge_transaction_error=__('api.charge_transaction_error');
            return response()->json(['status_code'=>400,'success' =>false,'message'=>$charge_transaction_error]);
        }
        if (Transaction::where('id', $data['id'])->exists()) {
            $updated = Transaction::where('id', $data['id'])->update($data);
            $charge_transaction_updated=__('api.charge_transaction_updated');
            return response()->json(['status_code'=>200,'success' =>true,'message'=>"Transaction updated successfully!",'data'=>$data]); 
        } else {
            $charge_transaction_updated=__('api.charge_transaction_empty');
            return response()->json(['status_code'=>400,'success' =>false,'message'=>$charge_transaction_updated]);            
          
        }
    } 


}
