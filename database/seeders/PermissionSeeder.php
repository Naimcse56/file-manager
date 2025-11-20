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

            ['name' => 'user-list','module' => 'System-Settings', 'sub_module' => 'User','guard_name' => 'web', 'parent_menu' => 'Mutual Assesment'],
            ['name' => 'user-create','module' => 'System-Settings', 'sub_module' => 'User','guard_name' => 'web', 'parent_menu' => 'Mutual Assesment'],
            ['name' => 'user-edit','module' => 'System-Settings', 'sub_module' => 'User','guard_name' => 'web', 'parent_menu' => 'Mutual Assesment'],
            ['name' => 'user-show','module' => 'System-Settings', 'sub_module' => 'User','guard_name' => 'web', 'parent_menu' => 'Mutual Assesment'],
            ['name' => 'user-delete','module' => 'System-Settings', 'sub_module' => 'User','guard_name' => 'web', 'parent_menu' => 'Mutual Assesment'],

            ['name' => 'role-list','module' => 'System-Settings', 'sub_module' => 'role','guard_name' => 'web', 'parent_menu' => 'Mutual Assesment'],
            ['name' => 'role-create','module' => 'System-Settings', 'sub_module' => 'role','guard_name' => 'web', 'parent_menu' => 'Mutual Assesment'],
            ['name' => 'role-edit','module' => 'System-Settings', 'sub_module' => 'role','guard_name' => 'web', 'parent_menu' => 'Mutual Assesment'],
            ['name' => 'role-permission','module' => 'System-Settings', 'sub_module' => 'role','guard_name' => 'web', 'parent_menu' => 'Mutual Assesment'],
        ];


        foreach ($permissions as $permission) {

            Permission::create($permission);

        }

        $role = Role::first();
        $role->syncPermissions(Permission::all());

        $user = User::find(1);
        $user->syncRoles([$role->name]);
    }
}
