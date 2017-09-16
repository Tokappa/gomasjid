<?php

use Illuminate\Database\Seeder;

use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'administrator';
        $role->display_name = 'Administrator';
        $role->description = 'Website Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'masjid';
        $role->display_name = 'Masjid';
        $role->description = 'GoMasjid User';
        $role->save();

    }
}
