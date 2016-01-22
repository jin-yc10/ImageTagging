<?php

namespace App\Http\Controllers\Back;

use App\Lottery;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Award;
use \App\AwardUser;
use Illuminate\Support\Facades\Session;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $awards = Award::paginate(5);
        $awards->setPath(url('/admin/award'));
        return view('back.award.index',compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('back.award.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'required|mimes:jpeg,bmp,png',
        ]);
        $input = $request->all();
        $image = $request->file('image');
        if($image->isValid()) {
            $clientName = $image->getClientOriginalName();
            $newName = date('ymdhis') . $clientName;
            $path = $image->move('storage/uploads/award', $newName);
            $input['image_path'] = $path;
        }
        Award::create($input);
        Session::flash('flash_message', '奖品'.$input['name'].'添加成功');

        return \Redirect::back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Award::destroy($id);
        Session::flash('flash_message', '奖品删除成功');

        return \Redirect::back();
    }
    /**
     *
     * @return \Illuminate\View\View
     */
    public function receive(){
        # status = 0 means user hasn't gotten this award
        $awardUsers = AwardUser::status(0)->orderBy('created_at')->paginate(5);
        $awardUsers->setPath(url('/admin/award/receive'));
        return view('back.award.receive',compact('awardUsers'));
    }

    public function gotten($id){
        $awardUser = AwardUser::findOrFail($id);
        $awardUser->is_gotten = true;
        $awardUser->save();

        Session::flash('flash_message', '奖品领取成功');

        return \Redirect::back();
    }



    /**
     * 返回显示所有已兑换商品视图
     */
    public function received(){
        # status = 1 means use has gotten this goods
        $awardUsers = AwardUser::status(1)->orderBy('created_at','desc')->paginate(5);
        $awardUsers->setPath(url('/admin/award/received'));
        return view('back.award.received',compact('awardUsers'));
    }
    public function add2lottery(Request $request){
        $input = $request->all();
        Lottery::create($input);
        Session::flash('flash_message',$input['name'].'加入奖盘成功');

        return \Redirect::back();
    }
}
