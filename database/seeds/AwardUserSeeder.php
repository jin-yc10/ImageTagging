<?php

use Illuminate\Database\Seeder;
use \App\User;
use \App\Award;
class AwardUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::find(2);
        foreach(range(11,19) as $index) {
            $award = Award::find($index);
            $user->Award()->attach($award);
        }
    }
}
