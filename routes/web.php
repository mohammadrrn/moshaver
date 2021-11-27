<?php

use App\Models\EstateRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $estateRequest = EstateRequest::where('status', 1)->orderBy('updated_at')->paginate(12);
    $data = [
        'estateRequest' => $estateRequest
    ];
    return view('site.index', compact('data'));
})->name('index');

Route::get('/detail/{id}', [\App\Models\Index::class, 'detail'])->name('detail');

Auth::routes();

Route::name('panel.')->prefix('panel')->group(function () {
    Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index'); // panel route
});


Route::post('/sendVerificationCode', [\App\Http\Controllers\VerificationController::class, 'sendVerificationCode']); // send verification sms for client

Route::name('request.')->prefix('request')->group(function () {
    Route::get('/requestForm', [App\Http\Controllers\RequestController::class, 'requestForm'])->name('requestForm');
    Route::post('/request', [App\Http\Controllers\RequestController::class, 'request'])->name('request');

    Route::get('/estateForm', [App\Http\Controllers\EstateRequestController::class, 'estateForm'])->name('estateForm');
    Route::post('/estate', [App\Http\Controllers\EstateRequestController::class, 'estate'])->name('estate');
});

Route::name('estateRequest.')->prefix('estateRequest')->middleware(['role:admin'])->group(function () {
    Route::get('/confirmedEstateRequestList', [App\Http\Controllers\EstateRequestController::class, 'confirmedEstateRequestList'])->name('confirmedEstateRequestList');
    Route::get('/unConfirmEstateRequest/{id}', [App\Http\Controllers\EstateRequestController::class, 'unConfirmEstateRequest'])->name('unConfirmEstateRequest');

    Route::get('/unconfirmedEstateRequestList', [App\Http\Controllers\EstateRequestController::class, 'unconfirmedEstateRequestList'])->name('unconfirmedEstateRequestList');
    Route::get('/confirmEstateRequest/{id}', [App\Http\Controllers\EstateRequestController::class, 'confirmEstateRequest'])->name('confirmEstateRequest');

    Route::get('/updateEstateRequestForm/{id}', [App\Http\Controllers\EstateRequestController::class, 'updateEstateRequestForm'])->name('updateEstateRequestForm');
    Route::patch('/updateEstateRequest/{id}', [App\Http\Controllers\EstateRequestController::class, 'updateEstateRequest'])->name('updateEstateRequest');

    Route::get('/deleteEstateRequestForm/{id}', [App\Http\Controllers\EstateRequestController::class, 'deleteEstateRequestForm'])->name('deleteEstateRequestForm');
    Route::delete('/deleteEstateRequest/{id}', [App\Http\Controllers\EstateRequestController::class, 'deleteEstateRequest'])->name('deleteEstateRequest');

});

Route::middleware('auth')->prefix('subscription')->name('subscription.')->group(function () {
    Route::get('/plans', [App\Http\Controllers\SubscriptionController::class, 'plans'])->name('plans');
    Route::get('/buy/{planId}/{itemId}', [App\Http\Controllers\SubscriptionController::class, 'buy'])->name('buy');
});

/*Route::group(['prefix' => 'author', 'middleware' => ['role:author|estateRequest']], function () {
    Route::get('/author', function () {
        echo "author level";
    });
});*/
