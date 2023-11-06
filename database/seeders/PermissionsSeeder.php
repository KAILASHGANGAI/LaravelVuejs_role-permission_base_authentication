<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'add']);
        Permission::create(['name' => 'view']);

        Permission::create(['name' => 'account-edit']);
        Permission::create(['name' => 'account-delete']);
        Permission::create(['name' => 'account-add']);
        Permission::create(['name' => 'account-view']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'teacher']);
        $role1->givePermissionTo('edit');
        $role1->givePermissionTo('delete');
        $role1->givePermissionTo('add');
        $role1->givePermissionTo('view');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('edit');
        $role2->givePermissionTo('delete');
        $role2->givePermissionTo('view');
        $role2->givePermissionTo('add');

        $role5 = Role::create(['name' => 'accountent']);
        $role5->givePermissionTo('account-edit');
        $role5->givePermissionTo('account-delete');
        $role5->givePermissionTo('account-view');
        $role5->givePermissionTo('account-add');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role4 = Role::create(['name' => 'student']);
        $role4->givePermissionTo('view');

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'teacher-teacher',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('password'),

        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($role4);

        $user = \App\Models\User::factory()->create([
            'name' => 'accountent',
            'email' => 'accountent@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole($role5);
    }
}
