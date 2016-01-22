<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StandardItem extends Model
{
    //
    protected $table = 'standard_items';
    protected $fillable = ['name', 'path','slug', 'dataset_id', 'batch_count'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function Dataset() {
        return $this->belongsTo('App\Dataset', "dataset_id", "id");
    }

    public function Items() {
        return $this->hasMany('App\Item', 'standard_item_id', 'id');
    }

    public function scopeNotDone($query) {
        return $query->where('remaining_count', '>', '0');
    }

    public static function StandardItemsMap($datasetID){
        $standardItems = StandardItem::where('dataset_id',$datasetID)->get();
        $standardMap = [];
        foreach($standardItems as $standardItem){
            $standardMap[$standardItem->slug] = $standardItem->id;
        }
        return $standardMap;
    }

}
