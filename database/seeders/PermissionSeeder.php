<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // USERS
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // ROLES
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            // ROLE PERMISSIONS
            'roles.permissions.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
