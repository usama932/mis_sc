<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.user-management.users.list');
    }

    public function create()
    {
        $roles = Role::all();
        $designations = Designation::all();
        return view('pages.apps.user-management.users.create',compact('roles','designations'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'permissions_level' => $request->permissions_level,
            'designation'       => $request->designation,
            'user_type'         => $request->user_type,
            'password'          => Hash::make($request->password),
            'status'            => '1',
        ]);
        $user->assignRole($request->role);
        return redirect()->back()->with("success", "PUser Created successfully!");
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
        return view('pages.apps.user-management.users.edit',compact('roles','designations','user'));
    }

    public function update(Request $request,$id)
    {   
        
        User::where('id', $id)->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'permissions_level' => $request->permissions_level,
            'designation'       => $request->designation,
            'user_type'         => $request->user_type,
          
        ]);
        $user = User::find($id);
        // $user->assignRole($request->role);
         $user->syncRoles($request->role);

        return redirect()->route('user-management.users.index')->with("success", "PUser Created successfully!");
    }

    public function destroy(User $user)
    {
        //
    }
}
