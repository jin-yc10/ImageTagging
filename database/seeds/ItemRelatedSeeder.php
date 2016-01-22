<?php

use Illuminate\Database\Seeder;

class ItemRelatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dataset = new \App\Dataset();
        $dataset->fill(['name'=>'test dataset', 'description'=>'这是个测试数据集']);
        $dataset->save();

        for($i=0; $i<10; $i++) {
            $si = new \App\StandardItem();
            $si->fill(['name'=>'test'.str_random(5),
                'path'=>'test/'.str_random(10),
                'dataset_id'=>$dataset->id]);
            $si->save();
        }
    }
}
