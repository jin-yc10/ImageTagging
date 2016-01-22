<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ItemUserRelation extends Model
{
    //
    protected $table = 'item_users';
    protected $fillable = ['batch_id','item_id','user_id'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function Item() {
        return $this->belongsTo('App\Item', "item_id", "id");
    }
    public function User() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
