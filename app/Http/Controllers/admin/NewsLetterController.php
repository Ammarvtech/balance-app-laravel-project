<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['page_title'] = "NewsLetter";
       $data['news'] = NewsLetter::paginate(10);
       return view('admin.news',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addNews(Request $request)
    {
         
          if($request->isMethod('post')){
            $data = request()->validate([
                'email' => 'required',
            ]);

            $data = $request->all();
            $slider = new NewsLetter;
            $slider->name = $data['name'];
            $slider->email = (!empty($data['email'])) ? $data['email'] : "";
            $slider->save();
            /*return redirect()->back()->with('flash_message_success','Product has been added successfully!');*/
            
            return redirect('blog')->with('flash_message_success','Blog  has been added successfully!');
        }
        return view('home.blog')->with('flash_message_error','Please again subscribe!');
    }

    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsLetter  $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function show(NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsLetter  $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsLetter  $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsLetter $newsLetter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsLetter  $newsLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsLetter $newsLetter)
    {
        //
    }
}
