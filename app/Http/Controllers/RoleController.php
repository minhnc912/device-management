<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        Role::create(['name' => $request->name]);
        return redirect()->route('roles.index');
    }

    public function editPermissions(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.permissions', compact('role', 'permissions'));
    }

    public function updatePermissions(Request $request, Role $role) {
        $role -> syncPermissions($request->permissions ?? []);
        return back();
    }
}
