<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPages;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmsPagesController extends Controller
{
    public function index(){
        $list = CmsPages::orderBy('title', 'ASC')->get();
        // return $list;
        return view('Admin.cms_pages.cms_page_list', ['list' => $list]);
    }

    public function addCmsPage(){
        return view('Admin.cms_pages.cms_page_add');
    }

    public function storeCmsPage(Request $request){
        $validator = Validator::make($request->all(), [
            'page_title' => 'required',
            'page_content' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $store = CmsPages::create([
            'title' => $request->page_title,
            'tag' => $request->tag,
            'details' => $request->page_content,
        ]);

        if(isset($store->id)){
            return back()->with(['success' => 'CMS page created successfully.']);
        }
        else{
            return back()->withErrors(['msg' => 'Error! CMS page not created.']);
        }
    }

    public function editCmsPage($id){
        $edit = CmsPages::where('id', $id)->first();
        // return $edit;
        if(!empty($edit) && $edit->id > 0){
            return view('Admin.cms_pages.cms_page_add', ['edit_cms' => $edit]);
        }
        else{
            // return back()->
        }
    }

    public function updateCmsPage(Request $request){
        $validator = Validator::make($request->all(), [
            'page_title' => 'required',
            'page_content' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $upd = CmsPages::where('id', $request->eid)
            ->update([
            'title' => $request->page_title,
                'tag' => $request->tag,
            'details' => $request->page_content,
        ]);

        if(isset($upd)){
            return back()->with(['success' => 'CMS page updated successfully.']);
        }
        else{
            return back()->withErrors(['msg' => 'Error! CMS page not updated.']);
        }
    }
}
