<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'A Administrator User';
        $role_admin->save();

        $role_editor = new Role();
        $role_editor->name = 'editor';
        $role_editor->description = 'A Editor User';
        $role_editor->save();

        $role_user = new Role();
        $role_user->name = 'user';
        $role_user->description = 'A User User';
        $role_user->save();
    }
}
