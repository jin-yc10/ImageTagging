<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dataset extends Model
{
    //
    protected $table = 'datasets';
    protected $fillable = ['name', 'description'];
    use SoftDeletes;


    protected $dates = ['deleted_at'];

    public function StandardItems() {
        return $this->hasMany('App\StandardItem', "dataset_id", "id");
    }

    public function Items()
    {
        return $this->hasManyThrough('App\StandardItem', 'App\Item','standard_item_id','dataset_id');
    }


    public function completed(){
        # total items count of this dataset
        $total = $this->StandardItems()->count() * 3;
        $completed = \DB::table('standard_items')->where('dataset_id',$this->id)->sum('batch_count');

        if ($total == 0){
            return 100;
        }
        return ($completed * 100) / $total;
    }

}
