<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // Basic roles data
        App\Role::insert([
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'editor'],
        ]);
    
        // Basic permissions data
        App\Permission::insert([
            ['name' => 'access.backend'],
            ['name' => 'create.user'],
            ['name' => 'edit.user'],
            ['name' => 'delete.user'],
            ['name' => 'create.article'],
            ['name' => 'edit.article'],
            ['name' => 'delete.article'],
        ]);
    
        // Add a permission to a role
        $role = App\Role::where('name', 'admin')->first();
        $role->addPermission('access.backend');
        $role->addPermission('create.user');
        $role->addPermission('edit.user');    
        $role->addPermission('delete.user');
        // ... Add other role permission if necessary
    
        // Create a user, and give roles
        $user = App\User::create([
            'email' => 'admin@example.com',
            'name' => 'Admin Aja',
            'password' => bcrypt('password'),
        ]);
    
        $user->assignRole('admin');
    }
}
