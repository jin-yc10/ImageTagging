<?php

use Illuminate\Database\Seeder;
use \App\Lottery;
use \App\Award;
class LotterySeeder extends Seeder
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
            $award = Award::find($index);

            $lottery = Lottery::create([
                'award_id' => $index,
                'prob' => random_int(1,100),
                'number' => random_int(1,100)

            ]);
        }
    }
}
