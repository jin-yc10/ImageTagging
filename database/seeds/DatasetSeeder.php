<?php

use Illuminate\Database\Seeder;
use \App\Http\Controllers\Back\DatasetController;
class DatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataset = \App\Dataset::create([
            'name' => '人脸数据集',
            'description' => '该数据集的标注任务是判断待标注人脸与给定标准人脸是否为同一个人，只需要选择是或者不是即可。标注正确即可获取相应的积分。',
        ]);
        $datasetController = new DatasetController();
        $datasetController->standardItem2DBImpl('public/dataset/facedataset/standard_item.csv',$dataset->id);
        $datasetController->item2DBImpl('public/dataset/facedataset/items.csv',$dataset->id);
        DB::unprepared('CALL create_batch()');
    }
}
