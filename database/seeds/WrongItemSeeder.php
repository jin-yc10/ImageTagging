<?php

use Illuminate\Database\Seeder;

class WrongItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(range(1,10) as $index){
            \App\WrongItem::create([
               'item_user_id' => $index,
            ]);
        }
    }
}
