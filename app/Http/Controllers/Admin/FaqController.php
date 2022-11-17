<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqController extends Controller
{
    // list all Faqs
    public function index(){

        $list = Faq::orderBy('title', 'ASC')->get();

        // return $list;
        return view('Admin.faqs.faqs_list', ['list' => $list]);

    }

    public function addFaq(){
        return view('Admin.faqs.faqs_add');
    }

    public function storeFaq(Request $request){
        // return $request;
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'quest_answer' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $store = Faq::create([
            'title' => $request->category_name,
            'details' => $request->quest_answer,
        ]);

        if(isset($store->id)){
            return back()->with(['success' => 'Faq created successfully.']);
        }
        else{
            return back()->withErrors(['msg' => 'Error! Faq not created.']);
        }
    }

    public function editFaq($id){
        $edit = Faq::where('id', $id)->get();

        return view('Admin.faqs.faqs_add', ['edit_faqs' => $edit]);
    }

    public function updateFaq(Request $request){
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'quest_answer' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $upd = Faq::where('id', $request->eid)->update([
            'title' => $request->category_name,
            'details' => $request->quest_answer,
        ]);

        if(isset($upd)){
            return back()->with(['success' => 'Faq updated successfully.']);
        }
        else{
            return back()->withErrors(['msg' => 'Error! Faq not updated.']);
        }
    }

    public function deteleFaq(Request $request){
        $id = $request->id;
        // return response($id);
        $del = Faq::where('id', $id)->delete();

        if($del){
            return response('success');
        }
        else{
            return response('error');
        }
    }
}
