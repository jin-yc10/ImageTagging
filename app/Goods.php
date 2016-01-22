<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    //
    protected  $table = 'goods';
    protected  $fillable = ['name','points','number','image_path'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function Users(){
        return $this->belongsToMany('\App\User','goods_user','goods_id','user_id');
    }



}
