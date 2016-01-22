<?php

use Illuminate\Database\Seeder;

use \App\Award;
class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();
        foreach(range(1,10) as $index){
            Award::create([
                'name' => $faker->sentence(1),
                'image_path' => $faker->sentence('1')
            ]);
        }

    }
}


