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

}
