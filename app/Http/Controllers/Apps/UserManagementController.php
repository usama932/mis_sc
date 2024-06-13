<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Theme;
use App\Models\Designation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\UserTheme;

class UserManagementController extends Controller
{

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.user-management.users.list');
    }

    public function create()
    {
        $designations = Designation::orderBy('designation_name')->get();
        $roles = Role::all();
        $themes = Theme::orderBy('name')->get();
        addJavascriptFile('assets/js/custom/users/create.js');
        return view('pages.apps.user-management.users.create',compact('designations','roles','themes'));
    }

    public function store(Request $request)
    {
      
        if(!empty($request->theme_id) && $request->role == "TA's"){
            $user = User::where('theme_id',$request->theme_id)->first();   
            if(empty($user)){
                $user = User::create([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'permissions_level' => $request->permissions_level,
                    'designation'       => $request->designation,
                    'province'          => $request->province,
                    'district'          => $request->district,
                    'theme_id'          => $request->theme_id,
                    'user_type'         => $request->user_type,
                    'password'          => Hash::make($request->password),
                    'status'            =>  $request->status,
                ]);
                $user->assignRole($request->role);
                return redirect()->back()->with("success", "User Created successfully!");
            }
            else{
                return redirect()->back()->with("danger", "User theme already exist!");
            }
        }   
        else{
          
            if($request->role != "TA's"){
                $user = User::create([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'permissions_level' => $request->permissions_level,
                    'designation'       => $request->designation,
                    'province'          => $request->province,
                    'district'          => $request->district,
                    'theme_id'          => $request->theme_id,
                    'user_type'         => $request->user_type,
                    'password'          => Hash::make($request->password),
                    'status'            => $request->status,
                ]);
                $user->assignRole($request->role);
                return redirect()->back()->with("success", "User Created successfully!");
            } 
            elseif($request->role == "TA's" &&  empty($request->theme_id)){
                return redirect()->back()->with("danger", "When Role is TA's then theme is necassary!");
            } 
            else{
                return redirect()->back()->with("danger", "Something went Wrong!");
            }
        }                                                          
     
    }

    public function show(User $user)
    {
        return view('pages.apps.user-management.users.show', compact('user'));
    }

    public function edit( $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $designations = Designation::all();
        $themes = Theme::orderBy('name')->get();
        return view('pages.apps.user-management.users.edit',compact('roles','designations','user','themes'));
    }

    public function update(Request $request,$id)
    {   

        if(!empty($request->theme_id) && $request->role == "TA's"){
          
            $user = User::where('theme_id',$request->theme_id)->first();   
            
            if($user == null ){
                $user = User::where('id', $id)->first(); 
                $user->update([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'permissions_level' => $request->permissions_level,
                    'designation'       => $request->designation,
                    'user_type'         => $request->user_type,
                    'theme_id'          => $request->theme_id,
                ]);
                $userr = User::where('id', $id)->first();
                $d = $userr->syncRoles($request->role); 
                
                return redirect()->back()->with("success", "User Created successfully!");
            }
            else{
                $user = User::where('id', $id)->first(); 
                $user->update([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'permissions_level' => $request->permissions_level,
                    'designation'       => $request->designation,
                    'user_type'         => $request->user_type,
                    'theme_id'          => $user->theme_id,
                ]);
                $userr = User::where('id', $id)->first();
                $d = $userr->syncRoles($request->role); 
                
                return redirect()->back()->with("success", "User Created successfully!");
            }
        }   
        else{
            if($request->role != "TA's" ){
                $user = User::where('id', $id)->first(); // Retrieve the user instance
                $user->update([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'permissions_level' => $request->permissions_level,
                    'designation'       => $request->designation,
                    'user_type'         => $request->user_type,
                    'theme_id'          => $request->theme_id,
                ]);
                $userr = User::where('id', $id)->first();
                $userr->syncRoles($request->role); 
                return redirect()->back()->with("success", "User Updated successfully!");
            }
            elseif($request->role == "TA's" &&  empty($request->theme_id)){
                return redirect()->back()->with("danger", "When Role is TA's then theme is necessary!");
            }
            else{
                return redirect()->back()->with("danger", "Some thing went wrong!");

            }
        }   
        
       
    }

    public function destroy(User $user)
    {
        //
    }
}
