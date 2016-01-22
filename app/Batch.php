<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Batch extends Model
{
    //
    //
    protected $table = 'batches';
    protected $fillable = ['standard_item_id','user_id','remain_count'];

    public function User() {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }
    public function StandardItem() {
        return $this->belongsTo('\App\StandardItem', 'standard_item_id', 'id');
    }
}
