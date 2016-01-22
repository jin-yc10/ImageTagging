<?php

namespace App\Http\Controllers\Lottery;

use App\Award;
use App\AwardUser;
use App\BigLottery;
use App\Lottery;
use App\LotteryUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LotteryController extends Controller
{



    /**
     * 根据概率获取奖项
     * @param unknown $proArr
     * @return Ambigous <string, unknown>
     *
     * 网上常用的抽奖算法
     */
    function getRand($proArr) {
        $result = '';

        //概率数组的总概率精度
        $proSum = array_sum($proArr);

        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);

        return $result;
    }






    public function create(){

        $lotterys=Lottery::all();
        $lottery_users=AwardUser::all();
        return view('mall.lottery',['lottery_users'=>$lottery_users,'lotterys'=>$lotterys]);
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
        /**
         *
         * php + ajax 幸运大转盘
         * @author Sim <326196998@qq.com>
         * @time 2014年9月25日15:37:32
         * @url http://www.yiifcms.com/post/59/
         *
         */

        $result['message']='0';
        $user=Auth::user();
        $points=$user->points;
        if($points<100){
            $result['message']='1';
        }
        else{


//            //奖项初始化
            $a=Lottery::all();
            foreach($a as $aaa){
                if($aaa->number==0){
                    $aaa->prob=0;
                    $aaa->save();
                }
            }

            $prize_arr = array(
                '0' => array('id'=>$a[0]->award_id,'min'=>1,'max'=>29,'prize'=>'一等奖','v'=>$a[0]->prob,'number'=>$a[0]->number),
                '1' => array('id'=>$a[1]->award_id,'min'=>302,'max'=>328,'prize'=>'二等奖','v'=>$a[1]->prob,'number'=>$a[1]->number),
                '2' => array('id'=>$a[2]->award_id,'min'=>242,'max'=>268,'prize'=>'三等奖','v'=>$a[2]->prob,'number'=>$a[2]->number),
                '3' => array('id'=>$a[3]->award_id,'min'=>182,'max'=>208,'prize'=>'四等奖','v'=>$a[3]->prob,'number'=>$a[3]->number),
                '4' => array('id'=>$a[4]->award_id,'min'=>122,'max'=>148,'prize'=>'五等奖','v'=>$a[4]->prob,'number'=>$a[4]->number),
                '5' => array('id'=>$a[5]->award_id,'min'=>62,'max'=>88,'prize'=>'六等奖','v'=>$a[5]->prob,'number'=>$a[5]->number),
                '6' => array('id'=>$a[6]->award_id,'min'=>array(32,92,152,212,272,332),
                    'max'=>array(58,118,178,238,298,358),'prize'=>'七等奖','v'=>$a[6]->prob,'number'=>$a[6]->number)
            );

            foreach ($prize_arr as $key => $val) {
                $arr[$val['id']] = $val['v'];
            }

            $rid = $this->getRand($arr); //根据概率获取奖项id
            $res = $prize_arr[$rid-1]; //中奖项

            $min = $res['min'];
            $max = $res['max'];
            if($res['id']==7){ //七等奖
                $i = mt_rand(0,5);
                $result['angle'] = mt_rand($min[$i],$max[$i]);
            }else{
                $result['angle'] = mt_rand($min,$max); //随机生成一个角度
            }



            $result['prize'] = $res['prize'];


            $award_id=$res['id'];
            $award=Lottery::findorFail($award_id);
            $award->number= $award->number-1;
            $award->save();


            \App\AwardUser::create(['user_id'=>$user->id,'award_id'=>$award_id,'is_gotten'=>'0','created_at'=>Carbon::now()]);
                // 这里如果采用先记录中奖信息，后台管理员兑奖时再从awards表中对number减1也可。

            $user->points = $user->points-100;
            $user->save();









        }
        //$user->save();
        //print $points;

        //echo $user_id;
        echo json_encode($result);
    }
    public function lottery(Request $request){



    }



    /*
     * the part of biglottery
     */


    public function create1(){

        $biglottery=BigLottery::all();

        return view('mall.bigLottery',['biglottery'=>$biglottery]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request)
    {
        $result['message']='0';
        $id=$_POST['id'];
        $user = Auth::user();
        $biglottery = BigLottery::findOrFail($id);

        $buy_point=$_POST['point'];
        $buy_num=$buy_point/100;


        if($user->points < $buy_point){
            $result['message']='1';
        }
        elseif($biglottery->remain>$buy_point)
        {

            $token = $biglottery->current/100;

//            \App\LotteryUser::create(['biglottery_id'=>$id,'user_id'=>$user->id,'token'=>$token+1]);
            for($i=0;$i<$buy_num;$i++)
            {
                \App\LotteryUser::create(['biglottery_id'=>$id,'user_id'=>$user->id,'token'=>$token+$i+1]);


            }

            $user->points=$user->points-$buy_point;
            $biglottery->current=$biglottery->current+$buy_point;
            $biglottery->remain=$biglottery->remain-$buy_point;
            $user->save();
            $biglottery->save();




        }
        else{
            $result['message']='2';

        }




        echo json_encode($result);
    }



}
