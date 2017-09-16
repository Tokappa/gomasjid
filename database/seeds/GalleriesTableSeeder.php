<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Carbon\Carbon;

use App\Gallery;


class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=1; $i<=100; $i++)
        {
            echo "Gallery ";
            echo $i;
            echo "\n";

            $gallery                = new Gallery();
            $gallery->masjid_id     = 9;
            $gallery->image_url     = $faker->imageUrl($width = 1600, $height = 900);
            $gallery->title         = $faker->realText($faker->numberBetween(10,20));
            $gallery->save();
        }
    }
}
