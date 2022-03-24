<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permissions
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'add card']);
        Permission::create(['name' => 'edit card']);
        Permission::create(['name' => 'view card']);
        Permission::create(['name' => 'delete card']);

        // Roles
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('add user');
        $admin->givePermissionTo('edit user');
        $admin->givePermissionTo('view user');
        $admin->givePermissionTo('delete user');

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('add card');
        $user->givePermissionTo('edit card');
        $user->givePermissionTo('view card');
        $user->givePermissionTo('delete card');

        // Create Admin account
        $admin = User::create([
            'fname' => 'Peter Carl',
            'lname' => 'Munoz',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'), // password
        ]);
        $admin->assignRole('admin');

        // Create user account
        $admin = User::create([
            'fname' => 'Jane',
            'lname' => 'Doe',
            'email' => 'peterpardo123@gmail.com',
            'password' => Hash::make('123'), // password
        ]);
        $admin->assignRole('user');
    }
}
