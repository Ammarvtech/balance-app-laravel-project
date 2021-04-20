<?php



namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;

use App\Mail\MyEmail;

use App\Contact;

use Illuminate\Http\Request;



class ContactUsController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

       $data['page_title'] = "Contact Queries";

       $data['contacts'] = Contact::orderBy('id','desc')->paginate(10);

       return view('admin.contact_us',$data);

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function addMail(Request $request, $id)

    {



          $user_info=Contact::where('id',$id)->first();

          $page_title= "Mail";

    

          return view('admin.add_mail')->with(compact('user_info','page_title'));

       



        //   $input = $request->all();

        //   $input['body'] = $request->input('body');

        //   $mail = Mail::orderBy('id','$id')->first();



        //   Mail::create($input);

        //     $data = array('name'=>"Devslogics");

        //     \Mail::send('admin/view_mail',$data, function($message) {



        //         {

        //           $message->to($mail); 

        //         }  

        //           $message->from('engineerlife021@gmail.com','Devslogics');

        //       });

        //     return redirect('admin/view-schedules')->with('flash_message_success','Mail has been added successfully!');

        //   }

        // }





    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function sendEmail(Request $request)

    {

        if($request->isMethod('post')){

          $request->validate([

              'body' => 'required',

          ]);

      

        $id= $reply=$request->input('id');

        $data['to_name']=Contact::where('id',$id)->pluck('name')->first();



        $data['to_email'] =Contact::where('id',$id)->pluck('email')->first();

        $data['message']=$request->input('body');

        $data['subject']="Balance App";

        Mail::to($data['to_email'])->send(new MyEmail($data));

        

        // $sendToUser = array( 

        //          "name" => "Team Tasali Media",

        //          "message" => 'It is requested you to cancel my subscription from TasaliMedia. Here is my credentials.<br><br>Name: '.$username.'<br>Email : '.$email.'<br><br> Best Regards: '.$username.'<br>',

        //          "template" => "frontend.dynamic_email_template",

        //          "subject" => "Cancel My Subscription"

        //      );

        //      mail::to($to_email)->send(new SendMail($sendToMedia));





        

         Contact::where('id', $id)->update(array('status' => 'done'));

         return redirect('contacts')->with('flash_message_success','Mail has been added successfully!');

    }



}



    /**

     * Display the specified resource.

     *

     * @param  \App\ContactUs  $contactUs

     * @return \Illuminate\Http\Response

     */

    public function show(ContactUs $contactUs)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\ContactUs  $contactUs

     * @return \Illuminate\Http\Response

     */

    public function edit(ContactUs $contactUs)

    {

        //

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\ContactUs  $contactUs

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, ContactUs $contactUs)

    {

        //

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\ContactUs  $contactUs

     * @return \Illuminate\Http\Response

     */

    public function deleteContact(Request $request ,$id )

    {

        if(!empty($id)){

        Contact::where(['id'=>$id])->delete();

        return redirect()->back()->with('flash_message_success','Message have been deleted Successfully!');

        }

    }

}

