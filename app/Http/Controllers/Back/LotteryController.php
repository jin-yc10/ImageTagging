<?php

namespace App\Http\Controllers\Back;

use App\Lottery;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LotteryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lotteries = Lottery::all();


        return view('back.award.lottery',compact('lotteries'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lottery = Lottery::findOrFail($id);

        return view('back.award.editlottery',compact('lottery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $input = $request->all();
        $lottery = Lottery::findOrFail($input['id']);
        $lottery->number = $input['number'];
        $lottery->prob = $input['prob'];
        $lottery->save();
        \Session::flash('flash_message','奖品'.$lottery->Award->name.'修改成功');
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
        $lottery = Lottery::findOrFail($id);
        $lottery->delete();
        \Session::flash('flash_message', "奖品".$lottery->Award->name."从奖盘删除成功");

        return \Redirect::back();
    }
}
