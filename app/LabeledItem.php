<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LabeledItem extends Model
{
    //
    protected $table = 'labeled_items';
    protected $fillable = ['item_id'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function Item() {
        return $this->belongsTo('App\Item', "item_id", "id");
    }
    public function Users() {
        return $this->belongsToMany('App\User', 'labeled_items_users', 'labeled_items_id', 'user_id');
    }
}
