<?php

use Illuminate\Database\Seeder;
use \App\User;
use \App\Goods;
class GoodsUserSeeder extends Seeder
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
        foreach(range(43,46) as $index) {
            $goods = Goods::find($index);
            $user->Goods()->attach($goods);
        }
    }
}
