<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use App\Events\UserSignedUp;
use App\Notifications\UserSignedUp as SignUpNotify;

$user = Auth::loginUsingId(1);
Route::get('/', function () {
    // 1- publish an event using redis
    // 2- Node.js and Redis subscribes to the event
    // 3- use socket.io to emit to all clients
    $data = [
        'event' => 'userSignedUp',
        'username' => 'amr mohamed',
        'id'       => 1,
    ];
    //Redis::publish('test-channel', json_encode($data));
    event(new UserSignedUp($data));
    //Auth::user()->notify(new SignUpNotify());
    return view('welcome');

});