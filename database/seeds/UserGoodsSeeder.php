<?php

use Illuminate\Database\Seeder;

class UserGoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = \App\User::find(1);
        foreach(range(20,30) as $index) {
            $goods = \App\Goods::find($index);
            $user->Goods()->attach($goods);
        }
    }
}
