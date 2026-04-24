<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function editRoles(User $user)
    {
        $roles = Role::all();
        return view('users.roles', compact('user', 'roles'));
    }

    public function updateRoles(Request $request, User $user) {
        $user -> syncRoles($request->roles ?? []);
        return back();
    }
}
