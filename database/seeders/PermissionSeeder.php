<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            ['name' => 'user-list','module' => 'System-Settings', 'sub_module' => 'User','guard_name' => 'web', 'parent_menu' => 'File Manager'],
            ['name' => 'user-create','module' => 'System-Settings', 'sub_module' => 'User','guard_name' => 'web', 'parent_menu' => 'File Manager'],
            ['name' => 'user-edit','module' => 'System-Settings', 'sub_module' => 'User','guard_name' => 'web', 'parent_menu' => 'File Manager'],
            ['name' => 'user-show','module' => 'System-Settings', 'sub_module' => 'User','guard_name' => 'web', 'parent_menu' => 'File Manager'],
            ['name' => 'user-delete','module' => 'System-Settings', 'sub_module' => 'User','guard_name' => 'web', 'parent_menu' => 'File Manager'],

            ['name' => 'role-list','module' => 'System-Settings', 'sub_module' => 'role','guard_name' => 'web', 'parent_menu' => 'File Manager'],
            ['name' => 'role-create','module' => 'System-Settings', 'sub_module' => 'role','guard_name' => 'web', 'parent_menu' => 'File Manager'],
            ['name' => 'role-edit','module' => 'System-Settings', 'sub_module' => 'role','guard_name' => 'web', 'parent_menu' => 'File Manager'],
            ['name' => 'role-permission','module' => 'System-Settings', 'sub_module' => 'role','guard_name' => 'web', 'parent_menu' => 'File Manager'],

            ['name' => 'email-config','module' => 'System-Settings', 'sub_module' => 'configuration','guard_name' => 'web', 'parent_menu' => 'File Manager'],
        ];


        foreach ($permissions as $permission) {

            Permission::create($permission);

        }

        $role = Role::first();
        $role->syncPermissions(Permission::all());

        // $user = User::find(1);
        // $user->syncRoles([$role->name]);
    }
}
