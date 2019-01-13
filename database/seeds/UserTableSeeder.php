<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = new User();
        $admin->name = 'Admin Name';
        $admin->email = 'admin@example.com';
        $admin->role = 'admin';
        $admin->password = bcrypt('secret');
        $admin->save();

        $editor = new User();
        $editor->name = 'Editor Name';
        $editor->email = 'editor@example.com';
        $admin->role = 'editor';
        $editor->password = bcrypt('secret');
        $editor->save();

        $user = new User();
        $user->name = 'User Name';
        $user->email = 'user@example.com';
        $admin->role = 'user';
        $user->password = bcrypt('secret');
        $user->save();
    }
}
