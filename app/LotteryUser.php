<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LotteryUser extends Model
{
    //
    protected $table = 'biglottery_user';
    protected $fillable = ['biglottery_id','user_id','token'];
    use SoftDeletes;


    public function BigLottery(){
        return $this->belongsTo('\App\BigLottery','biglottery_id','id');
    }
    public function User(){
        return $this->belongsTo('\App\User','user_id','id');
    }

}
