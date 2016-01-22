<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Lottery extends Model
{
    //
    protected $table = 'lottery';
    protected $fillable = ['award_id','prob','number'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function Award(){

        return $this->belongsTo('App\Award','award_id','id');
    }
    public function LotteryCount($use_id){

    }
}
