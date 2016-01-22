<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Item extends Model
{
    //
    protected $table = 'items';
    protected $fillable = ['path', 'standard_item_id', 'count'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function StandardItem() {
        return $this->belongsTo('App\StandardItem', "standard_item_id", "id");
    }
    public function Users() {
        return $this->belongsToMany('App\User', 'item_users', 'item_id', 'user_id');
    }


}
