<?php



namespace App\Http\Controllers\admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\User;

use Session;

use Auth;





use App\Order;

use App\OrderDetail;





class UsersController extends Controller{

	public function viewUsers(){

		$users = DB::table('users')->orderBy('id', 'DESC')->paginate(8);

        $page_title = "Users";

        return view('admin.view_users')->with(compact('users','page_title'));

	}

//faqs





    //add user

    public function addUser(Request $request){

        // if($request->isMethod('post')){

        //     $data = $request->all();

        //     $faqs = new Faq;

        //     $faqs->question = $data['name'];

        //     $faqs->answer = $data['email'];         

        //     $faqs->save();

        //return view ('admin/add_user');

            // return redirect('admin/add-faqs')->with('flash_message_success','Faq\'s has been added successfully!');

        //}

        $data['page_title'] = "Balance | App";

        $data['page'] = "Register";

        return view('admin/add_user', $data);

    }



    //save user

        public function saveuser(Request $request){

       if($request->isMethod('post')){

            $data = request()->validate([

                'name' => 'required',

                'email'    => 'required|email|max:255|unique:users',

                'password' => 'required|min:6',

               

            ]);



            $data = $request->all();

            $user = new User;

            $user->name = $data['name'];

            $user->email = $data['email'];

           

            $user->password = bcrypt($data['password']);

           

            $user->save();

            return redirect('view-users')->with('flash_message_success','You have registered Successfully!');

        }

    }



        public function detailsShow($user_id){

            $id=$user_id;

            $data['page_title'] = "Uder | Details";

            $data['page'] = "User Details";

            $data['user'] = DB::table('users')->find($id);

          //dd($data);

            return view('view_user_details',$data);

            // ->with('flash_message_success','You Profile Secure!');

        

    }

        



    //     $page_title = "Add Faq's";

    //     return view('admin.add_faq')->with(compact('page_title'));

    // }



    public function search(Request $request){

        $q = User::query();



        if ($request->name){

            $q->where('name','like','%'.$request->name.'%');

            $q->orWhere('email','like','%'.$request->name.'%');

        }



        $data['users'] = $q->orderBy('id','DESC')->paginate(10);

        $data['page_title'] = "Users";

        return view('admin.view_users', $data);

    }



    public function editUser($id){

        $data['details'] = DB::table('users')->where('id',$id)->first();

        $data['page_title'] = "Edit User";

        return view('admin.edit_user',$data);

    }



    public function updateUser(Request $request){

        if($request->isMethod('post')){

            $data = request()->validate([

                'name' => 'required',

            ]);

            if($request->password){

                $data = request()->validate([

                    'password' => 'required|min:6',

                ]); 

            }



            $data = $request->all();

            $newArray = array(

                'name' => $data['name']

            );

            if($request->password){

                $newArray['password'] = bcrypt($data['password']);

            }

            User::where(['id' => $data['id']])->update($newArray);

            return redirect('view-users')->with('flash_message_success','User details has been updated successfully!');

        }

    }



    public function deleteUser(Request $request, $id = null){

        if(!empty($id)){

            User::where(['id'=>$id])->delete();

            return redirect()->back()->with('flash_message_success','User has been deleted Successfully!');

        }

    }



    // Trainee Users

    public function viewTraineeUsers(){

        $data['users'] = DB::table('users')->where('type','trainee')->orderBy('id', 'DESC')->paginate(8);

        $data['page_title'] = "Trainee Users";

        return view('admin.view_trainee_users',$data);

    }



    public function searchTrainee(Request $request){

        $q = User::query();



        if ($request->name){

            $q->where('name','like',$request->name);

        }

        $q->where('type','trainee');

        $data['users'] = $q->orderBy('id','DESC')->paginate(10);

        $data['page_title'] = "Users";

        return view('admin.view_trainee_users', $data);

    }



    public function editTraineeUser($id){

        $data['details'] = DB::table('users')->where('id',$id)->first();

        $data['interest'] = array('Barista Skills','Sensory','Brewing','Green Coffee','Roasting'); 

        $data['page_title'] = "Edit User";

        return view('admin.edit_trainee_user',$data);

    }



    public function updateTraineeUser(Request $request){

        if($request->isMethod('post')){

            $data = request()->validate([

                'name' => 'required',

                'phone_number' => 'required',

            ]);

            if($request->password){

                $data = request()->validate([

                    'password' => 'required|min:6',

                ]); 

            }



            $data = $request->all();

            $newArray = array(

                'name' => $data['name'],

                'phone_number' => $data['phone_number'],

                'interests' => (isset($data['interests']) && $data['interests'] !="") ? implode(',', $data['interests']) : ""

            );

            if($request->password){

                $newArray['password'] = bcrypt($data['password']);

            }

            User::where(['id' => $data['id']])->update($newArray);

            return redirect('admin/view-trainee-users')->with('flash_message_success','User details has been updated successfully!');

        }

    }



}

