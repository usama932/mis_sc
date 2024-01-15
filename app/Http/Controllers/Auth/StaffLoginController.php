<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\StaffEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;


class StaffLoginController extends Controller
{
    public function login(Request $request)
    {
       
        $credentials = $request->validate([
            'email' => ['required', 'email'],
        ]);
        $randomNumber = random_int(1000, 9999);
        $user = StaffEmail::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make('UI9cNz93GZzA');
            $user->otp =  $randomNumber;
            $user->last_login_at = Carbon::now()->toDateTimeString();
            $user->last_login_ip =  $request->getClientIp();
            $user->updated_at = Carbon::now()->addMinutes(10);
            $user->expiry_time = Carbon::now()->addMinutes(10);
            $user->save();
            $email = encrypt($user->email);
            $details = [
                'title' => 'Your One-time Password Request',
               
                'otp'   => $randomNumber,
               
            ];
            Mail::to($request->email)->send(new \App\Mail\otpMail($details));
            $message = 'Congratulation! You are Registered Guest User';
            $Url = route('otp.form',$email);
            return response()->json([
                'message' => $message,
                'Url' => $Url
            ]);
        }
        else{
            $newuser = new StaffEmail;
            $newuser->email =$request->email;
            $newuser->name =$request->guest;
            $newuser->password = Hash::make('UI9cNz93GZzA');
            $newuser->password = Hash::make('UI9cNz93GZzA');
            $newuser->otp =  $randomNumber;
            $newuser->last_login_at = Carbon::now()->toDateTimeString();
            $newuser->last_login_ip =  $request->getClientIp();
            $newuser->updated_at = Carbon::now()->addMinutes(10);
            $newuser->expiry_time = Carbon::now()->addMinutes(10);
            $newuser->save();
            $email = encrypt($newuser->email);
            $details = [
                'title' => 'Your One-time Password Request',
                'otp'   => $randomNumber,
            ];
            Mail::to($request->email)->send(new \App\Mail\otpMail($details));
            $message = 'Congratulation! You are Registered Guest User';
            $Url = route('otp.form',$email);
            return response()->json([
                'message' => $message,
                'Url' => $Url
            ]);
          
        }
     
    }
    public function otp_form(Request $request,$email){
        $email = Crypt::decrypt($email);
        addJavascriptFile('assets/js/custom/authentication/sign-in/otp.js');
        return view('pages.auth.otp',compact('email'));
    }
    public function login_otp(Request $request){
        $request->validate([
            'otp'    => ['required', 'string']
        ]);

        $verificationCode = StaffEmail::where('email', $request->email)->where('otp', $request->otp)->first();
       
        $now = Carbon::now();
        if (!$verificationCode) {
            return response()->json([
                'message' =>'Your OTP is not correct'
            ]);
        
        }elseif($verificationCode && $now->isAfter($verificationCode->expiry_time)){
            return response()->json([
                'message' =>'Your OTP has been expired'
            ]);
          
        }
     
        if($verificationCode){
            $verificationCode->last_login_at = Carbon::now()->toDateTimeString();
            $verificationCode->last_login_ip =  $request->getClientIp();
            $verificationCode->updated_at = Carbon::now();
            $verificationCode->expiry_time = Carbon::now();
            $verificationCode->save();
          
            $credentials = [
                'email' => 'guest@savethechildren.org',  // Use the actual email from the database
                'password' => 'usama11usama',  // Use the actual password from the database
            ];
            session(['user_email' => $verificationCode->email]);
            session(['user_name' => $verificationCode->name]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
        
                $request->user()->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);
                return redirect()->intended(RouteServiceProvider::HOME);
                $message = 'You have successfully logged in!';
     
                return response()->json([
                    'message' => $message
                ]);
            }
          
        
        }
        
    }   
}
