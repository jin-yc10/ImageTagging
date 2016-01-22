<?php

namespace App\Http\Controllers\Lottery;

use App\Goods;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;

class GoodsController extends Controller
{


    public function create(){
//        $goods=DB::select('select * from goods order by points desc');
        $goods = Goods::all();
        return view('mall.goods',['goods'=>$goods]);
    }
    public function store(Request $request)
    {
        $goods_id=$_POST['id'];
        $user = Auth::user();
        $goods = Goods::findOrFail($goods_id);
        $result['message']='0';
        if($user->points < $goods->points){
            $result['message']='1';
        }
        else if($goods->number<=0||$goods->available==0){
            $result['message']='2';
        }
        else{
            $user->points = $user->points - $goods->points;
            $user->save();
            $user->Goods()->attach($goods);
            $goods->number=$goods->number-1;
            $goods->save();

        }



        return json_encode($result);


    }




}
