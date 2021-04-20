<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use Image;
use Validator;

class ContactController extends Controller
{
    public $successStatus = 200;
    public function index()
    {
        $contact = Contact::All();
        $category = json_decode(json_encode($contact));
        return response()->json(['success' =>true, "data"=> $contact], $this-> successStatus);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')){
           $data = Validator::make($request->all(), [ 
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'phone' => 'required|min:11|numeric',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required', 
           ]);
           if ($data->fails()) { 
               return response()->json(['error'=>$data->errors()], 401);            
           }
           $data = $request->all();
           $contact = new Contact;
           $contact->first_name = $data['first_name'];
           $contact->last_name = (!empty($data['last_name'])) ? $data['last_name'] : "";
           $contact->phone = (!empty($data['phone'])) ? $data['phone'] : "";
           $contact->email = (!empty($data['email'])) ? $data['email'] : "";
           $contact->subject = (!empty($data['subject'])) ? $data['subject'] : "";
           $contact->message = (!empty($data['message'])) ? $data['message'] : "";
           $contact->save();
           return response()->json(['success' =>true, "data"=>$contact], $this-> successStatus);
       }
       return response(['message' => 'Error, check your details'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact=Contact::find($id);
        if(is_null($contact)){
           return response()->json(["success"=>false,"data"=>"","message"=>"Record not Found"],404);
        }
        return response()->json(['success' => true, "data"=> $contact], $this-> successStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact=Contact::find($id);
        if(is_null($contact)){
           return response()->json(["success"=>false, "message"=>"Record not Found"],404);
        }
        $contact->delete();
        return response()->json(["success"=>true,"message"=>"Record have been deleted Successfully"],204);

    }
}
