<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Models\Designation;

class RegisteredUserController extends Controller
{
   
    public function create()
    {
        addJavascriptFile('assets/js/custom/authentication/sign-up/general.js');

        $designations = Designation::all();
        return view('pages.auth.register',compact('designations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'permissions_level' => 'nation-wide',
            'designation'       => $request->designation,
            'province'          => $request->province,
            'district'          => $request->district,
            'status'            => '1',
            'user_type'         => 'R2',
            'last_login_at'     => \Illuminate\Support\Carbon::now()->toDateTimeString(),
            'last_login_ip'     => $request->getClientIp()
        ]);
        $user->assignRole($request->role);
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
