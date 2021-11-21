<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function createUser(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'role' => 'required|exists:Spatie\Permission\Models\Role,name',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);

        $user->assignRole($request->role);
    }

    public function getRoles()
    {
        return Role::all();
    }

    public function getUsers()
    {
        return User::with('roles')->get();
    }
}
