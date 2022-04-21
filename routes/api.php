<?php

use App\Http\Controllers\api\v1\OldEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/v1')->group(function(){
    //users
    Route::post('/user/register',[UserController::class,'register']);
    Route::post('/user/login',[UserController::class,'login']);
    
    //old emails
    Route::middleware(['auth:api'])->group(function () {
        Route::get('/oldemails',[OldEmailController::class,'index']);
        Route::post('/oldemails',[OldEmailController::class,'store']);
        Route::get('/oldemails/{oldemail}',[OldEmailController::class,'show']);
        Route::put('/oldemails/{oldemail}',[OldEmailController::class,'update']);
        Route::delete('/oldemails/{oldemail}',[OldEmailController::class,'destroy']);
    });

});
