<?php

use Illuminate\Database\Seeder;


use Faker\Factory as Faker;
use App\News;


class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=1; $i<=5; $i++)
        {
            echo "News ";
            echo $i;
            echo "\n";

            $news   = new News();
            $news->masjid_id    = 1;
            $news->content      = $faker->realText($faker->numberBetween(100,150));
            $news->save();
        }
    }
}
