<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
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

        AuthService::register($request->email, $request->name, $request->password, $request->role, '');
    }

    public function getRoles()
    {
        return Role::all();
    }

    public function getUsers()
    {
        return User::with('roles')->get();
    }

    public function removeUser(Request $request)
    {
        User::findorfail($request->user_id)->delete();
    }

    public function changeAvatar(Request $request)
    {

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            $filenameWithExt = $avatar->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $avatar->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $avatar->storeAs('public', $fileNameToStore);
        }

        User::where('email', $request->user_email)->update(['avatar' => $fileNameToStore]);

        return ['avatar' => $path];
    }
}
