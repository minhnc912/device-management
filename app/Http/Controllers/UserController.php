<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users.view')->only(['index', 'show']);
        $this->middleware('permission:users.create')->only(['create', 'store']);
        $this->middleware('permission:users.edit')->only(['edit', 'update', 'editRoles', 'updateRoles']);
        $this->middleware('permission:users.delete')->only(['destroy']);
    }
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->role) {
            $query->role($request->role);
        }

        $users = $query->get();

        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }
    public function editRoles(User $user)
    {
        $roles = Role::all();
        return view('users.roles', compact('user', 'roles'));
    }

    public function updateRoles(Request $request, User $user)
    {
        $user->syncRoles($request->roles ?? []);
        return back();
    }
}
