<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }

    public function reset_password()
    {
        return view('pages.auth.resetpasswordfromadmin');
    }

    public function password_update(Request $request)
    {
        
        $validator = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
            
        ]);
      
        if(!Hash::check($request->old_password, auth()->user()->password)){
           
            return redirect()->back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with("success", "Password changed successfully!");
    }
}
