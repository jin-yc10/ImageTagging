<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index')->with('datasets',DB::table('datasets')->orderBy('id')->get());
});


Route::group([
    'prefix' => 'admin',
    'namespace' => 'Back',
    'middleware' => ['auth','reception']
], function(){
    Route::get("/","BackController@index");
    /**
     * Goods Routes
     */
    Route::get('goods/receive','GoodsController@receive');
    Route::get('goods/{id}/gotten','GoodsController@gotten');
    Route::get('goods/{id}/cancel','GoodsController@cancel');
    Route::get('goods/received','GoodsController@received');

    /**
     * Award Routes
     */
    Route::get('award/receive','AwardController@receive');
    Route::get('award/received','AwardController@received');
    Route::get('award/{id}/gotten','AwardController@gotten');
});
//
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Back',
    'middleware' => ['auth','admin']
], function(){
    /**
     * Dataset Routes
     */
    Route::get('dataset','DatasetController@index');
    Route::get('dataset/create',function(){
        return view('back.dataset.create');
    });
    Route::post('dataset','DatasetController@store');
    Route::get('dataset/{id}/edit','DatasetController@edit');
    Route::post('dataset/update','DatasetController@update');
    Route::get('dataset/{id}/destroy','DatasetController@destroy');
    Route::get('dataset/{id}/import/standarditem',function($id){
        return view('back.dataset.import.standarditem')->with('dataset',\App\Dataset::findOrFail($id));
    });
    Route::post('dataset/import/standarditem','DatasetController@importStandardItem');
    Route::get('dataset/{id}/import/item',function($id){
        return view('back.dataset.import.item')->with('dataset',\App\Dataset::findOrFail($id));
    });
    Route::post('dataset/import/item','DatasetController@importItem');

    /**
     * Goods Routes
     */
    Route::get('goods/create','GoodsController@create');
    Route::post('goods/store','GoodsController@store');
    Route::get('goods','GoodsController@index');
    Route::get('goods/{id}/edit','GoodsController@edit');
    Route::post('goods/update','GoodsController@update');
    Route::get('goods/{id}/destroy','GoodsController@destroy');
    Route::get('goods/{id}/available','GoodsController@available');
    Route::get('goods/{id}/unavailable','GoodsController@unavailable');

    /**
     * Awards Routes
     */
    Route::get('award/create','AwardController@create');
    Route::post('award/store','AwardController@store');
    Route::get('award','AwardController@index');
    Route::get('award/{id}/destroy','AwardController@destroy');
    Route::post('award/add2lottery','AwardController@add2lottery');

    /**
     * Lottery Routes
     */
    Route::get('award/lottery','LotteryController@index');
    Route::get('lottery/{id}/edit','LotteryController@edit');
    Route::post('lottery/update','LotteryController@update');
    Route::get('lottery/{id}/destroy','LotteryController@destroy');


    /**
     * User Routes
     */
    Route::get('user','UserController@index');
    Route::get('user/appeals','UserController@appeal');
    Route::get('user/appeal/{id}/pass','UserController@pass');
    Route::get('user/appeal/{id}/failed','UserController@failed');
    Route::get('user/{id}/lock','UserController@lock');
    Route::get('user/{id}/unlock','UserController@unlock');
    Route::get('user/{id}/destroy','UserController@destroy');
    Route::get('user/appeal','UserController@appeal');
    Route::get('user/{id}/deladmin','UserController@deladmin');
    Route::get('user/{id}/add2admin','UserController@add2admin');
    Route::get('user/{id}/delreception','UserController@delreception');
    Route::get('user/{id}/add2reception','UserController@add2reception');
});



Route::group([
    'prefix'=>'tag',
    'middleware' => ['auth','locked']
    ], function(){
    Route::get('/', function(){

        return view('tag.index',['datasets'=>\App\Dataset::all()]);
    });
    Route::get('/{id}', function($id){
        return view('tag.tag',['dataset'=>\App\Dataset::find($id)]);
    });

});

Route::group([
    'prefix'=>'tag',
    'middleware' => ['auth','locked']
], function(){
    Route::get('/',function(){
        return view('tag.index',[
            'datasets'=>\App\Dataset::all(),
            'user'=>Auth::user(),
        ]);
    });
    Route::get('/{id}', 'TagController@getNext');
    Route::post('/{id}', 'TagController@postLabel');
});

Route::group(['prefix' => 'u'], function()
{
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');

    // Registration routes...
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');

});


Route::group([
    'prefix'=>'u',
    'middleware' => ['auth']
], function(){
    Route::get('profile',function(){
        return view('user.profile',['user'=>\Illuminate\Support\Facades\Auth::user()]);
    });
    Route::get('editpassword',function(){
        return view('user.editpassword');
    });
    Route::post('editpassword','UserController@editPassword');
    Route::get('wrongitem','UserController@wrongitem');
    Route::get('goods','UserController@goods');
    Route::get('awards','UserController@awards');
    Route::get('lottery','UserController@lottery');

//    Route::get('goods',function(){
//        return view('user.goods',['user'=>\Illuminate\Support\Facades\Auth::user()]);
//    });
//    Route::get('awards',function(){
//        return view('user.awards',['user'=>\Illuminate\Support\Facades\Auth::user()]);
//    });
//    Route::get('lottery',function(){
//        return view('user.lottery',['user'=>\Illuminate\Support\Facades\Auth::user()]);
//    });

//    Route::get('wrongitem',function(){
//        return view('user.wrongitem',['user'=>\Illuminate\Support\Facades\Auth::user()]);
//    });
    Route::get('appeal/{id}','UserController@appeal');


});

Route::group([
    'prefix'=>'gl',
    'middleware' => ['auth','locked']
], function(){
    Route::get('/', function(){
        return view('lottery.index');
    });
    Route::get('/goods','Lottery\GoodsController@create');
    Route::post('/goods','Lottery\GoodsController@store');

    //Route::post('/goods/{id}','Lottery\GoodsController@store');

    Route::get('/lottery','Lottery\LotteryController@create');
    Route::post('/lottery','Lottery\LotteryController@store');


    Route::get('/biglottery','Lottery\LotteryController@create1');
    Route::post('/biglottery','Lottery\LotteryController@store1');
});


