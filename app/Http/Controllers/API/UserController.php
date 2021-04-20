<?php



namespace App\Http\Controllers\API;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User; 

use Illuminate\Support\Facades\Auth; 

use Illuminate\Support\Str;

use Validator;

use Mail;

use Image;



class UserController extends Controller

{

    

    ////////////LOGIN\\\\\\\\\\\

    public function login(){ 

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





    ////////////REGISTER\\\\\\\\\\\\\\\\\\\

    public function register(Request $request) 

    { 

        $validator = Validator::make($request->all(), [ 

            'name' => 'required', 

            'email' => 'required|email|unique:users,email', 

            'password' => 'required', 

            'c_password' => 'required|same:password', 

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

        if($request->hasFile('image')){

            $image_tmp = $request->image; //Input::file('image');

            if($image_tmp->isValid()){

                $extension = $image_tmp->getClientOriginalExtension();

                $filename = rand(111,99999).'.'.$extension;

                $image_path = public_path('images/home/'.$filename);

                Image::make($image_tmp)->resize(300,300)->save($image_path);

                $data['image'] = $filename;

            }

        }else{

            $data['image'] = "84264.jpg";

        }

        $data['verificationcode'] = rand(11111,99999);

            $data['password'] = bcrypt($data['password']); 



            $data['user']  = User::create($data); 

            $data['token'] =   $data['user']->createToken('MyApp')->accessToken;

            //Email PROCESS

                $data = array('name'=>$data['name'],'email'=>$data['email'],'verificationcode'=>$data['verificationcode']);

                $sendMail = Mail::send('emails.mail', $data, function($message) use ($data){

                $message->to($data["email"], $data["name"],$data["verificationcode"])->subject

                ('Activate your Account');

                $message->from('engineerlife021@gmail.com');

                });

                // unset($data['password']);

                // unset($data['token']);

            //////////End EMAIL PROCESS

        return response()->json(['status_code'=>200,'success' =>true,'message'=>"Successfully Register!","data"=> $data]);

    }





    /////////////CHANGE PASSWORD\\\\\\\\\\\\\\\\

    public function changePassword(Request $request){

        $user = Auth::user();

        $validator = Validator::make($request->all(), [ 

            'password' => 'required', 

            'c_password' => 'required|same:password', 

        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            $message = "";

            foreach ($errors->toArray() as $key => $value) {

                 $message.= $value[0];

             }          

            return response()->json(['status_code'=>400,'success' =>false,'message'=>$message]);            

        }

        $data = $request->all();

        if($data ==  NULL){

            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Please enter data!"]);

        }

        if (User::where('id', $user->id)->exists()) {

            $data['password'] = bcrypt($data['password']);

            $data = array('password' => $data['password']);

            $updated = User::where('id', $user->id)->update($data);

            return response()->json(['status_code'=>200,'success' =>true,'message'=>"Successfully Password changed!"]); 

        } else {

            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Password cannot changed!"]);            

        }

    }





    /////////////////EMAIL VERIFICATION\\\\\\\\\\\

     public function emailVerify(Request $request){

        $validator = Validator::make($request->all(), [ 

            'email' => 'required|email'

        ]);

       if ($validator->fails()) {

            $errors = $validator->errors();

            $message = "";

            foreach ($errors->toArray() as $key => $value) {

                 $message.= $value[0];

             }          

            return response()->json(['status_code'=>400,'success' =>false,'message'=>$message]);            

        }

        $data = $request->all();

        if (User::where('email', $data['email'])->where('verificationcode', $data['verificationcode'])->exists()) {

            $getUser =  User::where('email', $data['email'])->where('verificationcode', $data['verificationcode'])->first();

            $user = array('verified' => true);

            $updated = User::where('id', $getUser->id)->update($user);

            return response()->json(['status_code'=>200,'success' =>true,'message'=>"Account verified successfully!"]); 

        } else {

            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Email or Verification Code are inccorect!"]);                         

        }

      }





    

    ///////////////Forget Password\\\\\\\\\\\\\\

    public function forgetPassword(Request $request) 

    { 

        $validator = Validator::make($request->all(), [ 

            'email' => 'required|email'

        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            $message = "";

            foreach ($errors->toArray() as $key => $value) {

                 $message.= $value[0];

             }          

            return response()->json(['status_code'=>400,'success' =>false,'message'=>$message]);            

        }

        $data = $request->all();

        $mail=$data['email'];

        $user = User::where('email', $mail)->first();

        if ($user == ""){

           return response()->json(['status_code'=>400,'success' =>false,'message'=>"No account avialable against this email!"]);  

        }else{

            $data['verificationcode'] =rand(11111,99999);

            $verificationcode = array('verificationcode' => $data['verificationcode']);

            $user = User::where('email', $mail)->update($verificationcode);

            $data['name'] = User::where('email', $mail)->pluck('name')->first();

            //////////Email process\\\\\\\\

            $data = array('name'=>$data['name'],'email'=>$data['email'],'verificationcode'=>$data['verificationcode']);

            $sendMail = Mail::send('emails.mail', $data, function($message) use ($data){

            $message->to($data["email"],$data["verificationcode"])->subject

            ('Activate your Account');

            $message->from('engineerlife021@gmail.com');

            });

            // unset($data['name']);

            //////////End process\\\\\\\\

            return response()->json(['status_code'=>200,'success' =>true,'message'=>"Check email for account verification!",'data'=>$data]); 

        }

    }

   



    /////////////USER DETAILS\\\\\\\\\\\\\

    public function details() 

    { 

        $user = Auth::user(); 

        return response()->json(['status_code'=>200,'success' =>true,'message'=>"User details!",'data'=>$user]); 

    } 

     



    /////////////UPDATE PROFILE\\\\\\\\\\\\

    public function updateProfile(Request $request) 

    { 

        $user = Auth::user();

        $data = $request->all();

        if($request->hasFile('image')){

            $image_tmp = $request->image; //Input::file('image');

            if($image_tmp->isValid()){

                $extension = $image_tmp->getClientOriginalExtension();

                $filename = rand(111,99999).'.'.$extension;

                $image_path = 'images/home/'.$filename;

                Image::make($image_tmp)->resize(300,300)->save($image_path);

                $data['image'] = $filename;

            }

        }

        if($data ==  NULL){

            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Please enter data!"]);

        }

        if (User::where('id', $user->id)->exists()) {

            User::where('id', $user->id)->update($data);
            $updated = User::where('id', $user->id)->first();
           // 61496.jpg
            $updated['image']="https://balanceapp.gcc-demo.com/images/home/".$updated['image'];
           // $image=unset($updated['image']);

            return response()->json(['status_code'=>200,'success' =>true,'message'=>"Profile updated successfully!",'data'=>$updated]); 

        } else {

            return response()->json(['status_code'=>400,'success' =>false,'message'=>"Profile cannot be updated!"]);            

          

        }

    } 

    



    ///////////////LOGOUT\\\\\\\\\\\\

    public function logoutApi(){ 

        if (Auth::check()) {

            Auth::user()->AauthAcessToken()->delete();

            return response()->json(['status_code'=>200,'success' =>true,'message'=>"Logout successfully!"]);  

        }



    }

}

