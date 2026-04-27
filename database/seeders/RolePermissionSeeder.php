<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ['view device', 'create device', 'edit device', 'delete device'];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = ['admin', 'manager', 'leader', 'employee'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('12345678'),
            ],
        );

        $admin->assignRole('admin');

        // Assign all permissions to the admin role
        Role::findByName('admin')->givePermissionTo(Permission::all());
    }
}
