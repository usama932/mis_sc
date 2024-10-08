<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\StaffEmail;
use App\Models\LoginLog;

class AuthenticatedSessionController extends Controller
{

    public function create()
    {
        addJavascriptFile('assets/js/custom/authentication/sign-in/general.js');
        addJavascriptFile('assets/js/custom/authentication/sign-in/guest.js');
        return view('pages.auth.login');
    }


    public function store(LoginRequest $request)
    {
       
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            if(auth()->user()->status == 1){
                $request->session()->regenerate();
 
                $request->user()->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);
                LoginLog::create([
                    'user_id' =>auth()->user()->id,
                    'login_ip' =>  $request->getClientIp(),
                    
                ]);
                return redirect()->intended(RouteServiceProvider::HOME);
            }
            else{
                Auth::logout();
                return response()->json([
                    'message' => "Your Credentials are Approved yet",
                    'error' => true
                ]);
            }
            
        }else{
            return response()->json([
                'message' => "Your Credentials are incorrect",
                'error' => true
            ]);
        }
    }
    
    public function postguest_login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        
        $user = StaffEmail::where('email', $request->email)->first();
        
        if ($user) {
            $credentials = [
                'email' => 'guest@savethechildren.org',  // Use the actual email from the database
                'password' => 'usama11usama',  // Use the actual password from the database
            ];
            session(['user_email' => $user->email]);
            session(['user_name' => $user->name]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
        
                $request->user()->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);
                LoginLog::create([
                    'user_id' => $user->id,
                    'login_ip' =>  $request->getClientIp(),
                    
                ]);
                return redirect()->intended(RouteServiceProvider::HOME);
                $message = 'You have successfully logged in!';
     
                return response()->json([
                    'message' => $message
                ]);
            }
        }
        else{
            $message = 'You Emails is not Registered!';
     
            return response()->json([
                'message' => $message
            ]);
        }
    }
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
