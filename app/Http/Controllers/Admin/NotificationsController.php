<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Notification;
use DB;
use Validator;
use Mail;
use App\Mail\Admin\ManualNotification;


class NotificationsController extends Controller
{
    public function index(){
        $notif = Notification::join('users as u', 'u.id', '=', 'notifications.user_id')
                ->whereNull('notifications.deleted_at')
                ->select('u.first_name', 'u.last_name', 'u.email', 'notifications.title', 'notifications.details', 'notifications.created_at')
                ->get();

        // return $notif;
        return view('Admin.notifications.notifications_list', ['list' => $notif]);
    }

    public function sendNotif(){
        $user = User::select('id', DB::raw("CONCAT(first_name,' ',last_name) as full_name"))->orderby('full_name', 'ASC')
                ->get();
        // return $user;
        return view('Admin.notifications.notifications_add', ['user' => $user]);
    }

    public function storeNoftif(Request $request){
        // return $request;
        $validator = Validator::make($request->all(), [
            // 'user_name' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'notification_type' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $ul = $request->user_name;
        // return $ul;
        $usr_inf = User::whereIn('id', $ul)
                    ->select('first_name', 'last_name', 'email', 'id')
                   ->get();

        // return $usr_inf;
        $err = 0;
        foreach ($usr_inf as $key => $value) {
            // send mail
                // Mail::to($value->email)->send(new ManualNotification($value->first_name, $request->subject, $request->message));

                // if(Mail::failures() != 0) {
                    // insert notification

            $insert = Notification::create([
                'user_id' => $value->id,
                'title' => $request->subject,
                'details' => $request->message,
                'type' => $request->notification_type,
            ]);

            if(!isset($insert->id)){
                $err++;
            }
    
        }

        if($err == 0){
            return back()->with(['success' => 'Notification sent successfully.']);
        }
        else{
            return back()->withErrors(['msg' => 'Error! in sending notification.']);
        }

    }

    public function findUser(Request $request){
        $search = $request->search;

        $user = User::select("id",DB::raw("CONCAT(first_name,' ',last_name, ' (', email, ')') as full_name"))->limit(10)
                ->where('first_name', 'LIKE', '%'.$search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                ->get();

                $output = '<ul class="dropdown-menu" style="display:block; position:absolute">';
                  foreach($user as $row)
                  {
                   $output .= '
                   <li data-id="'.$row->id.'"><a href="#">'.$row->full_name.'</a></li>
                   ';
                  }
                  $output .= '</ul>';
                  echo $output;
    }


    // public function getUserInfo(){

    // }
}
