<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GoodsUser extends Model
{
    //
    protected $table = 'goods_user';
    protected $fillable = ['is_used'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function Goods(){
        return $this->belongsTo('\App\Goods','goods_id','id');
    }
    public function User(){
        return $this->belongsTo('\App\User','user_id','id');
    }

    public function scopeStatus($query,$status) {
        return $query->where('is_gotten', $status);
    }
}
