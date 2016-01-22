<?php

use Illuminate\Database\Seeder;
use \App\Goods;
use \App\GoodsUser;

class GoodsSeeder extends Seeder
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

        foreach(range(1,40) as $index){
            Goods::create([
                'name' => $faker->sentence(1),
                'points' => $faker->numberBetween(100,2000),
                'number' => $faker->numberBetween(1,100),
                'image_path'=>$faker->sentence(10),
            ]);
        }

    }
}
