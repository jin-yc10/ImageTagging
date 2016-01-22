<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WrongItem extends Model
{
    //
    protected $table = 'wrong_item_user_labels';
    protected $fillable = ['item_user_id', 'is_appeal'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function ItemUserRelation() {
        return $this->belongsTo('App\ItemUserRelation', "item_user_id", "id");
    }


    public function scopeUnpassedAppeal($query){
        $query->where('is_appeal',true)
              ->where('is_appeal_passed','=',-1);
    }

}
