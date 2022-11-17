<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use App\Models\Admin;
use Mail;
use App\Mail\Admin\ForgotPwd;

class AdminLoginController extends Controller
{
    //
    public function index()
    {
        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.dash');
        }

        return view('Admin.pages.user-pages.login');
    }

    public function dash()
    {
        return view('Admin.dashboard');
    }

    public function admLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }


        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            // echo "admin logged success";
            return redirect()->route('admin.dash');
        }
        else{
            return back()->withErrors("Invalid email or password.");
        }


    }

    public function adminLogout(Request $request){

        if (Auth::guard('admin')->check()) {
            // return "admin auth checked";
            Auth::guard('admin')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
        }

        // return redirect('admin/login');
        return redirect()->route('admin.login');
    }

    public function forgotPass(){
        return view('Admin.pages.user-pages.forgot_pass');
    }

    public function forgotPassMail(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $adm = Admin::where('email', $request->email)->get();

            if(!empty($adm)){
                $adm =  $adm[0];
                $current_time = time();
                // dd($adm['email']."___".$current_time);
                $token = base64_encode(convert_uuencode(base64_encode($adm['email']."___".$current_time)));
                // dd($token);
                Mail::to($adm['email'])->send(new ForgotPwd($adm['name'], $token));

                if(Mail::failures() != 0) {
                    return back()->withErrors('Success! password reset link has been sent to your email');
                }
                else{

                    return back()->withErrors('Failed! there is some issue with email provider');
                }
            }
            else{
                    return back()->withErrors("This email is not registered");
            }

    }


    public function checkLink($token){
        $decode = base64_decode(convert_uudecode(base64_decode($token)));

        $decode = explode('___', $decode);
        $email = $decode[0];

        // dd($email);
        $link_time = $decode[1];
        $now = time();

        $interval  = abs($now - $link_time);
        $minutes   = round($interval / 60);

        if( $minutes > 240 ){
            return "this link has expired.";
        }
        else{
            // echo "link valid";
            return $this->resetPass($email);
        }


    }

    public function resetPass($email){
        // echo $email;
        return view('Admin.pages.user-pages.reset_pass', ['email' => $email]);
    }

    public function newPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $password = bcrypt($request->password);
        $upd = Admin::where('email', $request->email)->update(['password' => $password]);

        if($upd){
            // echo "password saved successfully";
            Auth::guard('admin')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect()->route('admin.login')->withErrors('Success! password has been changed. Please login with new password');
        }
        else{
            // echo "error in setting new password";
            return back()->withErrors("Error in setting new password");
        }
    }

    public function changePassword(){
        $admin = Auth::guard('admin')->user();
        // return $admin->email;
        return $this->resetPass($admin->email);
    }

}
