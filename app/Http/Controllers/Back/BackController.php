<?php

namespace App\Http\Controllers\Back;

use App\AwardUser;
use App\Dataset;
use App\GoodsUser;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $newGoods = GoodsUser::where('is_gotten',false)->count();
        $newAwards = AwardUser::where('is_gotten',false)->count();
        $receivedGoods = GoodsUser::where('is_gotten',true)->count();
        $receivedAwards = AwardUser::where('is_gotten',true)->count();
        $datasets = Dataset::all();

        return view('back.index',compact('newGoods','newAwards',
                                'receivedGoods','receivedAwards',
                                'datasets'));
    }

}
