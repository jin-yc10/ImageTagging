<?php

namespace App\Http\Controllers;

use App\WrongItem;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function editPassword(Request $request){
        $this->validate($request, [
            'oldPassword' => 'required|min:6|max:50',
            'newPassword' => 'required|min:6|max:50|confirmed',
        ]);
        $input = $request->all();
        $oldPassword = $input['oldPassword'];
        $newPassword = $input['newPassword'];
        $user = \Auth::user();
        if (strlen($oldPassword) > 0 && !Hash::check($oldPassword,$user->password)){
            return \Redirect::back()->withErrors('请输入正确的当前密码');
        }
        $user->password = Hash::make($newPassword);
        $user->save();
        Session::flash('flash_message', '密码修改成功');
        return \Redirect::back();
    }
    public function appeal($id){
        $wrongItem = WrongItem::findOrFail($id);
        $wrongItem->is_appeal = 1;
        $wrongItem->save();
        Session::flash('flash_message', '申诉申请已提交,请等待管理人员审核.');
        return \Redirect::back();
    }
    public function wrongitem(){
        $wrongItems = \Auth::user()->WrongItem()->orderBy('updated_at','desc')->paginate(5);

        $wrongItems->setPath(url('/u/wrongitem'));

        return view('user.wrongitem',compact('wrongItems'));
    }
    public function goods(){
        $goodsUsers = \Auth::user()->GoodsUser()->orderBy('updated_at','desc')->paginate(5);

        $goodsUsers->setPath(url('/u/goods'));

        return view('user.goods',compact('goodsUsers'));
    }
    public function awards(){
        $awardUsers = \Auth::user()->AwardUser()->orderBy('updated_at','desc')->paginate(5);

        $awardUsers->setPath(url('/u/awards'));

        return view('user.awards',compact('awardUsers'));
    }
    public function lottery(){
        $lotteryUsers = \Auth::user()->LotteryUser()->orderBy('updated_at','desc')->get();

//        $lotteryUsers->setPath(url('/u/lottery'));

        return view('user.lottery',compact('lotteryUsers'));
    }

}
