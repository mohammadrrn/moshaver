<?php

use App\Models\EstateRequest;
use App\Models\Permission;
use Illuminate\Support\Facades\Notification;
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

Route::get('/saeed', function () {

    //auth()->user()->attachPermission('user-requests-list');
    //return view('test');
    //auth()->user()->attachPermission('zoonkan');
});


/*Route::get('/send', [App\Http\Controllers\SiteController::class, 'send'])->name('send');
Route::get('/received', [App\Http\Controllers\SiteController::class, 'received'])->name('received');*/


/* --------------- Public Routes ---------------  */
Route::get('/', function () {
    $estateRequest = EstateRequest::with('estateType')->with('book')->where('status', 1)->orWhere('status', 2)->orderBy('updated_at')->paginate(12); //
    $data = [
        'estateRequest' => $estateRequest
    ];
    return view('site.index', compact('data'));
})->name('index');

Route::get('/detail/{id}', [App\Http\Controllers\SiteController::class, 'detail'])->name('detail');

Route::get('/trustedOfficesList', [App\Http\Controllers\SiteController::class, 'trustedOfficesList'])->name('trustedOfficesList');

Route::get('/search/{type?}', [App\Http\Controllers\SiteController::class, 'search'])->name('search');
Route::post('/search/result', [App\Http\Controllers\SiteController::class, 'searchResult'])->name('searchResult');

Route::post('/bookmarked', [App\Http\Controllers\SiteController::class, 'bookmarked'])->name('bookmarked');

Route::get('/block', [App\Http\Controllers\SiteController::class, 'block'])->name('block');
Route::post('/sendVerificationCode', [\App\Http\Controllers\VerificationController::class, 'sendVerificationCode']); // send verification sms for client

Route::name('request.')->prefix('request')->group(function () {
    Route::get('/requestForm', [App\Http\Controllers\RequestController::class, 'requestForm'])->name('requestForm');
    Route::post('/request', [App\Http\Controllers\RequestController::class, 'request'])->name('request');

    Route::get('/estateForm', [App\Http\Controllers\EstateRequestController::class, 'estateForm'])->name('estateForm');
    Route::post('/estate', [App\Http\Controllers\EstateRequestController::class, 'estate'])->name('estate');
});

Route::get('/forgetPassword', [\App\Http\Controllers\SiteController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/sendResetPasswordCode', [\App\Http\Controllers\SiteController::class, 'sendResetPasswordCode'])->name('sendResetPasswordCode');
Route::post('/resetPasswordForm', [\App\Http\Controllers\SiteController::class, 'resetPasswordForm'])->name('resetPasswordForm');
Route::post('/resetPassword', [\App\Http\Controllers\SiteController::class, 'resetPassword'])->name('resetPassword');

/* --------------- Public Routes ---------------  */

Auth::routes();

Route::name('panel.')->prefix('panel')->middleware(['block', 'auth'])->group(function () {


    Route::get('/redirectTo/{link}', [App\Http\Controllers\HomeController::class, 'redirectTo'])->name('redirectTo');

    /* --------------- Payment Route ---------------  */

    Route::get('/pay/{rialPrice}/{planId}/{itemId}', [App\Http\Controllers\SiteController::class, 'pay'])->name('pay');
    Route::get('/verify/{invoiceId}', [App\Http\Controllers\SiteController::class, 'verify'])->name('verify');

    /* --------------- Payment Route ---------------  */

    Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->middleware('completeProfile'); // panel route


    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

    Route::patch('/updateProfile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::patch('/changePassword', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('changePassword');

    Route::get('/estateRequest/myEstateRequest', [App\Http\Controllers\EstateRequestController::class, 'myEstateRequest'])->name('estateRequest.myEstateRequest');
    Route::name('estateRequest.')->prefix('estateRequest')->group(function () {

        Route::get('/confirmedEstateRequestList', [App\Http\Controllers\EstateRequestController::class, 'confirmedEstateRequestList'])->name('confirmedEstateRequestList')->middleware(['permission:confirmed-request-list']);
        Route::post('/unConfirmEstateRequest', [App\Http\Controllers\EstateRequestController::class, 'unConfirmEstateRequest'])->name('unConfirmEstateRequest')->middleware(['permission:confirmed-request-list']);

        Route::get('/unconfirmedEstateRequestList', [App\Http\Controllers\EstateRequestController::class, 'unconfirmedEstateRequestList'])->name('unconfirmedEstateRequestList')->middleware(['permission:unconfirmed-request-list']);
        Route::post('/confirmEstateRequest', [App\Http\Controllers\EstateRequestController::class, 'confirmEstateRequest'])->name('confirmEstateRequest')->middleware(['permission:unconfirmed-request-list']);

        Route::get('/updateEstateRequestForm/{id}', [App\Http\Controllers\EstateRequestController::class, 'updateEstateRequestForm'])->name('updateEstateRequestForm')->middleware(['permission:update-estate-request']);
        Route::patch('/updateEstateRequest/{id}', [App\Http\Controllers\EstateRequestController::class, 'updateEstateRequest'])->name('updateEstateRequest')->middleware(['permission:update-estate-request']);

        Route::get('/deleteEstateRequestForm/{id}', [App\Http\Controllers\EstateRequestController::class, 'deleteEstateRequestForm'])->name('deleteEstateRequestForm')->middleware(['permission:delete-estate-request']);
        Route::delete('/deleteEstateRequest/{id}', [App\Http\Controllers\EstateRequestController::class, 'deleteEstateRequest'])->name('deleteEstateRequest')->middleware(['permission:delete-estate-request']);

        Route::post('/rejectConfirmation', [App\Http\Controllers\EstateRequestController::class, 'rejectConfirmation'])->name('rejectConfirmation')->middleware(['permission:reject-confirmation-estate-request']);

    });

    Route::get('/request/myRequest', [App\Http\Controllers\RequestController::class, 'myRequest'])->name('request.myRequest')->middleware('completeProfile');
    Route::get('/request/userRequests', [App\Http\Controllers\RequestController::class, 'userRequests'])->name('request.userRequests')->middleware('completeProfile');

    Route::name('request.')->prefix('request')->middleware(['role:admin|writer'])->group(function () {

        Route::get('/confirmedRequestList', [App\Http\Controllers\RequestController::class, 'confirmedRequestList'])->name('confirmedRequestList');
        Route::post('/unConfirmRequest', [App\Http\Controllers\RequestController::class, 'unConfirmRequest'])->name('unConfirmRequest');

        Route::get('/unconfirmedRequestList', [App\Http\Controllers\RequestController::class, 'unconfirmedRequestList'])->name('unconfirmedRequestList');
        Route::post('/confirmRequest', [App\Http\Controllers\RequestController::class, 'confirmRequest'])->name('confirmRequest');

        Route::get('/updateRequestForm/{id}', [App\Http\Controllers\RequestController::class, 'updateRequestForm'])->name('updateRequestForm');
        Route::patch('/updateRequest/{id}', [App\Http\Controllers\RequestController::class, 'updateRequest'])->name('updateRequest');

        Route::get('/deleteRequestForm/{id}', [App\Http\Controllers\RequestController::class, 'deleteRequestForm'])->name('deleteRequestForm');
        Route::delete('/deleteRequest/{id}', [App\Http\Controllers\RequestController::class, 'deleteRequest'])->name('deleteRequest');

    });

    Route::name('writer.')->prefix('writer')->middleware(['role:admin'])->group(function () {
        Route::get('/addWriterForm', [App\Http\Controllers\WriterController::class, 'addWriterForm'])->name('addWriterForm');
        Route::post('/addWriter', [App\Http\Controllers\WriterController::class, 'addWriter'])->name('addWriter');
        Route::post('/inactive/{id}', [App\Http\Controllers\WriterController::class, 'inactive'])->name('inactive');
        Route::post('/active/{id}', [App\Http\Controllers\WriterController::class, 'active'])->name('active');

        Route::get('/writerActions/{id}', [App\Http\Controllers\WriterController::class, 'writerActions'])->name('writerActions');
        Route::post('/searchAction', [App\Http\Controllers\WriterController::class, 'searchAction'])->name('searchAction');
        Route::get('/updateForm/{id}', [App\Http\Controllers\WriterController::class, 'updateForm'])->name('updateForm');
        Route::post('/update', [App\Http\Controllers\WriterController::class, 'update'])->name('update');
    });

    Route::name('trustedOffices.')->prefix('trustedOffices')->middleware(['role:admin'])->group(function () {

        Route::get('/addTrustedOfficesForm', [App\Http\Controllers\TrustedOfficeController::class, 'addTrustedOfficesForm'])->name('addTrustedOfficesForm');
        Route::post('/addTrustedOffices', [App\Http\Controllers\TrustedOfficeController::class, 'addTrustedOffices'])->name('addTrustedOffices');

        Route::get('/updateTrustedOfficesForm/{id}', [App\Http\Controllers\TrustedOfficeController::class, 'updateTrustedOfficesForm'])->name('updateTrustedOfficesForm');
        Route::post('/updateTrustedOffices/{id}', [App\Http\Controllers\TrustedOfficeController::class, 'updateTrustedOffices'])->name('updateTrustedOffices');

    });

    Route::prefix('subscription')->name('subscription.')->group(function () {
        Route::get('/plans', [App\Http\Controllers\SubscriptionController::class, 'plans'])->name('plans')->middleware('completeProfile');
        Route::get('/buy/{planId}/{itemId}', [App\Http\Controllers\SubscriptionController::class, 'buy'])->name('buy')->middleware('completeProfile');
    });

    Route::prefix('users')->name('users.')->middleware(['role:admin'])->group(function () {
        Route::get('/usersList', [App\Http\Controllers\UserController::class, 'usersList'])->name('usersList');
        Route::post('/inactive', [App\Http\Controllers\UserController::class, 'inactive'])->name('inactive');
        Route::post('/active', [App\Http\Controllers\UserController::class, 'active'])->name('active');
    });

    Route::prefix('zoonkan')->name('zoonkan.')->middleware('completeProfile')->group(function () {
        Route::get('/createZoonkanForm', [App\Http\Controllers\ZoonkanController::class, 'createZoonkanForm'])->name('createZoonkanForm');
        Route::post('/createZoonkan', [App\Http\Controllers\ZoonkanController::class, 'createZoonkan'])->name('createZoonkan');
        Route::post('/addToZoonkan', [App\Http\Controllers\ZoonkanController::class, 'addToZoonkan'])->name('addToZoonkan');
        Route::get('/zoonkanFiles/{zoonkanId}', [App\Http\Controllers\ZoonkanController::class, 'zoonkanFiles'])->name('zoonkanFiles');
        Route::post('/removeFormZoonkan', [App\Http\Controllers\ZoonkanController::class, 'removeFormZoonkan'])->name('removeFormZoonkan');
    });

    Route::prefix('invoice')->name('invoice.')->middleware('completeProfile')->group(function () {
        Route::get('/invoicesList', [App\Http\Controllers\InvoiceController::class, 'invoicesList'])->name('invoicesList');
    });

    Route::prefix('cession')->name('cession.')->middleware('role:admin|writer')->group(function () {
        Route::get('/report/{estateRequestId}', [App\Http\Controllers\CessionController::class, 'report'])->name('report');
        Route::get('/reportsList', [App\Http\Controllers\CessionController::class, 'reportsList'])->name('reportsList');
        Route::post('/confirmCession/{estateRequestId}', [App\Http\Controllers\CessionController::class, 'confirmCession'])->name('confirmCession');
        Route::post('/unconfirmedCession/{estateRequestId}', [App\Http\Controllers\CessionController::class, 'unconfirmedCession'])->name('unconfirmedCession');
        Route::post('/confirmCessionManual/{estateRequestId}', [App\Http\Controllers\CessionController::class, 'confirmCessionManual'])->name('confirmCessionManual');
    });

    Route::prefix('area')->name('area.')->middleware('role:admin')->group(function () {
        Route::get('/addAreaForm', [App\Http\Controllers\AreaController::class, 'addAreaForm'])->name('addAreaForm');
        Route::post('/addArea', [App\Http\Controllers\AreaController::class, 'addArea'])->name('addArea');
        Route::get('/areaList', [App\Http\Controllers\AreaController::class, 'areaList'])->name('areaList');
        Route::get('/editAreaForm/{id}', [App\Http\Controllers\AreaController::class, 'editAreaForm'])->name('editAreaForm');
        Route::post('/editArea/{id}', [App\Http\Controllers\AreaController::class, 'editArea'])->name('editArea');
        Route::get('/disableArea/{id}', [App\Http\Controllers\AreaController::class, 'disableArea'])->name('disableArea');
        Route::get('/enableArea/{id}', [App\Http\Controllers\AreaController::class, 'enableArea'])->name('enableArea');
    });

    Route::prefix('city')->name('city.')->middleware('role:admin')->group(function () {
        Route::get('/addCityForm', [App\Http\Controllers\CityController::class, 'addCityForm'])->name('addCityForm');
        Route::post('/addCity', [App\Http\Controllers\CityController::class, 'addCity'])->name('addCity');
        Route::get('/cityList', [App\Http\Controllers\CityController::class, 'cityList'])->name('cityList');
        Route::get('/editCityForm/{id}', [App\Http\Controllers\CityController::class, 'editCityForm'])->name('editCityForm');
        Route::post('/editCity/{id}', [App\Http\Controllers\CityController::class, 'editCity'])->name('editCity');
    });

    Route::prefix('contact')->name('contact.')->middleware('role:admin')->group(function () {
        Route::get('/contactList', [App\Http\Controllers\ContactController::class, 'contactList'])->name('contactList');
        Route::post('/addContact', [App\Http\Controllers\ContactController::class, 'addContact'])->name('addContact');
    });

    Route::prefix('reminder')->name('reminder.')->group(function () { // ->middleware('role:admin')
        Route::get('/addReminderForm', [App\Http\Controllers\ReminderController::class, 'addReminderForm'])->name('addReminderForm');
        Route::post('/addReminder', [App\Http\Controllers\ReminderController::class, 'addReminder'])->name('addReminder');
    });

    Route::prefix('notification')->name('notification.')->group(function () {
        Route::get('/notificationList', [App\Http\Controllers\NotificationController::class, 'notificationList'])->name('notificationList');
    });
});


/*Route::group(['prefix' => 'author', 'middleware' => ['role:author|estateRequest']], function () {
    Route::get('/author', function () {
        echo "author level";
    });
});*/
