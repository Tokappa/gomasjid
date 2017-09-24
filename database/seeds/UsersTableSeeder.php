<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

use App\Role;
use App\User;
use App\Masjid;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');


        // Administrator
        $api_token = str_random(25);

        $role = Role::where('name', 'administrator')->first();
        $user = new User();
        $user->name = 'The Admin Man';
        $user->phone = $faker->phoneNumber;
        $user->email = 'admin@yahoo.com';
        $user->password = bcrypt('asdfasdf');
        $user->api_token = $api_token;
        $user->is_verified = 1;
        $user->save();
        $user->attachRole($role);

        // Masjid
        $api_token = str_random(25);

        $role = Role::where('name', 'masjid')->first();
        $user = new User();
        $user->name = 'John Masjid';
        $user->phone = $faker->phoneNumber;
        $user->email = 'masjid@yahoo.com';
        $user->password = bcrypt('asdfasdf');
        $user->api_token = $api_token;
        $user->is_verified = 1;
        $user->save();
        $user->attachRole($role);

        $masjid = Masjid::firstOrCreate(['user_id' => $user->id]);
        $masjid->contact_name = $faker->name;
        $masjid->contact_phone = $faker->phoneNumber;
        $masjid->address = $faker->streetAddress;
        $masjid->save();

    }
}
