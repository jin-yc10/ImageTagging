<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BigLottery extends Model
{
    //
    protected $table = 'bigLottery';
    protected $fillable = ['name','image_path','sum','current','remain'];
    use SoftDeletes;

    public function Users(){
        return $this->belongsToMany('\App\User','biglottery_user','biglottery_id','user_id');
    }

}
