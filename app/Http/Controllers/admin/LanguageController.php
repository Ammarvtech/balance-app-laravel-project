<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\Language;

class LanguageController extends Controller
{
    public function addLanguage(Request $request){
        if($request->isMethod('post')){
            $data = request()->validate([
                'name' => 'required',
            ]);

            $data = $request->all();
            $languages = new Language;
            $languages->name = $data['name'];           
            $languages->directory = $data['directory'];           
            $languages->status = $data['status'];           
            $languages->font = $data['font'];           
            $languages->direction = $data['direction'];           
            if(!empty($data['name'])){
                $languages->save();
                return redirect('view-language')->with('flash_message_success','Language\'s has been added successfully!');
            }
    	}
    	$page_title = "Add Language's";
    	return view('admin.add_language')->with(compact('page_title'));
    }

    public function viewLanguage(){
        $languages = DB::table('language')->paginate(10);
        $page_title = "Languages";
        
        return view('admin.view_languages')->with(compact('languages','page_title'));
    }

    public function editLanguage(Request $request, $language_id = null){
        if($request->isMethod('post')){
            $data = request()->validate([
                'name' => 'required',
            ]);

            
            $data = $request->all();
            $newArray = array(
                'name' => $data['name'],
                'directory' => $data['directory'],
                'status' => $data['status'],
                'font' => $data['font'],
                'direction' => $data['direction'],
            );
            Language::where(['language_id'=>$language_id])->update($newArray);
            return redirect('view-language')->with('flash_message_success','Language\'s details updated Successfully!');
        }

        $page_title = "Edit Language";
        $languages = Language::where(['language_id'=>$language_id])->first();        
        return view('admin.edit_languages')->with(compact('languages','page_title'));
    }

    public function deleteLanguage($language_id = null){
        if(!empty($language_id)){
            Language::where(['language_id'=>$language_id])->delete();
            return redirect()->back()->with('flash_message_success','Language\'s deleted Successfully!');
        }
    }



    ////////////////////Add_page\\\\\\\\\\\\\\\\\\\\\

    
}
