<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserManagementController extends Controller
{
    //
    public function user_list()
    {
        $user_detail = User::orderBy('first_name', 'ASC')->get();
        return view('Admin.users.index',compact('user_detail'));
    }

    public function export_data()
    {
        return Excel::download(new UserExport(),'users.xlsx');
    }

    public function user_active(Request $request){

        // return $request->id;
        $ex = explode('_', $request->id);

        if($ex[1] == 0){
            $status = 1;
        }
        else{
            $status = 0;
        }

        $upd = User::where('id', $ex[0])
                ->update(['is_active' => $status]);

        if($upd){
            return "success";
        }
        else{
            return "error";
        }
    }



}
