<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\API\GiftController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\BassController as BassController;
use App\Http\Controllers\API\ResetPasswordController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\VerificationController as APIVerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\API\CartController;

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

/*
//the original
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::middleware(['auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::get('logout', [RegisterController::class, 'loggedOut']);

//-------------------------------------------------------

//reset password
Route::post('/forgot/password', 'API\ForgotPasswordController@forgotPassword');
Route::post('/password/reset', 'API\ForgotPasswordController@passwordReset');
Route::post('/resend/code', 'API\ForgotPasswordController@resendCode');

//-------------------------------------------------------

Route::get('/verified-only', function (Request $request) {
    dd('you are verified', $request->user()->name);
})->middleware('auth:sanctum', 'verified');

//to verify the link in the email
Route::post('/email/verify', 'API\VerificationController@emailVerify')->middleware('auth:api');

//-------------------------------------------------------

//gift route i update route
Route::resource('/gifts', 'API\GiftController'::class);


//categorys route
Route::resource('/categorys', 'API\CategoryController'::class);

//cart route
Route::resource('/carts', 'API\CartController'::class);



//order route
Route::resource('/orders', 'API\OrderController'::class);

//review route i update route
Route::group(['prefix'=>'gifts'], function(){
    Route::resource('/{gift}/reviews', 'API\ReviewController'::class);


});




/*
// ما احتاجها بجرب شيئ ثاني
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
*/
