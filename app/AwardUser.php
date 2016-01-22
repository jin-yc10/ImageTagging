<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwardUser extends Model
{
    //
    protected $table = 'award_user';
    protected $fillable = ['user_id','award_id','is_gotten'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function scopeStatus($query,$status) {
        return $query->where('is_gotten', $status);
    }

    public function Award(){
        return $this->belongsTo('\App\Award','award_id','id');
    }
    public function User(){
        return $this->belongsTo('\App\User','user_id','id');
    }


}
