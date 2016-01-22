<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Award extends Model
{
    //
    protected $table = 'awards';
    protected $fillable = ['name','image_path'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function Users(){
        return $this->belongsToMany('\App\User','award_user','award_id','user_id');
    }
    public function Lottery(){
        return $this->hasOne('\App\Lottery','award_id','id');
    }
    public function isInLottery(){
        return \App\Lottery::where('award_id',$this->id)->count() >= 1;
    }
}
