<?php

namespace App\Http\Controllers\Back\Reception;

use App\AwardUser;
use App\GoodsUser;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newGoods = GoodsUser::where('is_gotten',false)->count();
        $newAwards = AwardUser::where('is_gotten',false)->count();
        return view('back.reception.index',compact('newGoods','newAwards'));
    }

    public function awards(){
        # status = 0 means user hasn't gotten this award

        $awardUsers = AwardUser::status(0)->orderBy('created_at')->paginate(5);
        $awardUsers->setPath(url('/back/reception/awards'));
        return view('back.reception.awards',compact('awardUsers'));
    }
    public function goods(){
        # status = 0 means user hasn't gotten this goods
        $goodsUsers = GoodsUser::status(0)->orderBy('created_at')->paginate(5);
        $goodsUsers->setPath(url('/back/reception/goods'));
        return view('back.reception.goods',compact('goodsUsers'));
    }
    public function receiveGoods($id){
        $goodsUser = GoodsUser::findOrFail($id);
        $goodsUser->is_gotten = true;
        $goodsUser->save();

        Session::flash('flash_message', '兑换商品领取成功');

        return \Redirect::back();
    }
    public function receiveAward($id){
        $awardUser = AwardUser::findOrFail($id);
        $awardUser->is_gotten = true;
        $awardUser->save();

        Session::flash('flash_message', '奖品领取成功');

        return \Redirect::back();
    }
    public function cancelGoods($id){
        $goodsUser = GoodsUser::findOrFail($id);
        $user = $goodsUser->User;
        $goods = $goodsUser->Goods;
        $user->points += $goods->points;
        $user->save();
        $goodsUser->delete();
        Session::flash('flash_message', '取消兑换商品成功');

        return \Redirect::back();
    }
}
