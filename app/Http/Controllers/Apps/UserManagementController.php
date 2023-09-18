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
        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'province'          => $request->province,
            'district'          => $request->district,
            'permissions_level' => $request->permissions_level,
            'designation'       => $request->designation,
            'password'          => Hash::make($request->password),
            'status'            => '1',
        ]);
     
    }

    public function show(User $user)
    {
        return view('pages.apps.user-management.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
