<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Goods;
use Illuminate\Support\Facades\Session;
use \App\GoodsUser;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $goods = Goods::paginate(5);

        $goods->setPath(url('/admin/goods'));
        return view('back.goods.index',compact('goods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.goods.create');
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'number' => 'required|integer|min:0',
            'points' => 'required|integer:min:0',
            'image' => 'required|mimes:jpeg,bmp,png',
        ]);
        $input = $request->all();
        $image = $request->file('image');
        if($image->isValid()) {
            $clientName = $image->getClientOriginalName();
            $newName = date('ymdhis') . $clientName;
            $path = $image->move('storage/uploads/goods', $newName);
            $input['image_path'] = $path;
        }
        Goods::create($input);
        Session::flash('flash_message', '商品'.$input['name'].'添加成功');

        return \Redirect::back();
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
        $goods = Goods::findOrFail($id);
        return view('back.goods.edit',compact('goods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        //
        $this->validate($request, [
            'id' => 'required|integer',
            'name' => 'required|max:255',
            'number' => 'required|integer|min:0',
            'points' => 'required|integer:min:0',
        ]);
        $input = $request->all();
        $goods = Goods::findOrNew($input['id']);
        $goods->name = $input['name'];
        $goods->number = $input['number'];
        $goods->points = $input['points'];

        $goods->save();

        Session::flash('flash_message', '商品'.$input['name'].'修改成功');

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
        Goods::destroy($id);
        Session::flash('flash_message', '商品删除成功');

        return \Redirect::back();

    }

    /**
     * 商品上架
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function available($id)
    {
        $good = Goods::findOrFail($id);
        $good->available = true;
        $good->save();
        Session::flash('flash_message', '商品'.$good->name."上架成功");

        return \Redirect::back();

    }
    /**
     * 商品下架
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unavailable($id)
    {
        $good = Goods::findOrFail($id);
        $good->available = false;
        $good->save();
        Session::flash('flash_message', '商品'.$good->name."下架成功");

        return \Redirect::back();

    }


    /**
     *
     * @return \Illuminate\View\View
     */
    public function receive(){
        # status = 0 means user hasn't gotten this goods
        $goodsUsers = GoodsUser::status(0)->orderBy('created_at','desc')->paginate(5);
        $goodsUsers->setPath(url('/admin/goods/receive'));
        return view('back.goods.receive',compact('goodsUsers'));
    }

    public function gotten($id){
        $goodsUser = GoodsUser::findOrFail($id);
        $goodsUser->is_gotten = true;
        $goodsUser->save();
        Session::flash('flash_message', '兑换商品领取成功');

        return \Redirect::back();
    }

    /**
     * 取消用户兑换商品
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel($id){
        $goodsUser = GoodsUser::findOrFail($id);
        $user = $goodsUser->User;
        $goods = $goodsUser->Goods;
        $user->points += $goods->points;
        $user->save();
        $goodsUser->delete();
        Session::flash('flash_message', '取消兑换商品成功');

        return \Redirect::back();
    }

    /**
     * 返回显示所有已兑换商品视图
     */
    public function received(){
        # status = 1 means use has gotten this goods
        $goodsUsers = GoodsUser::status(1)->orderBy('created_at')->paginate(5);
        $goodsUsers->setPath(url('/admin/goods/sell'));
        return view('back.goods.received',compact('goodsUsers'));
    }
}
