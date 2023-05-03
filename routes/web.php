<?php

use Illuminate\Support\Facades\Route;
use Illuminate\http\Request;
use App\Http\Controllers\BulkMailerController;
use App\Http\Controllers\OpenRateController;
use App\Http\Controllers\IndexController;
use App\Models\bulkMailer;
use App\Jobs\test;
use Illuminate\Support\Facades\Artisan;

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
// Route::get('testQueue',[OpenRateController::class,function(){
//     test::dispatch();
// }]);
Route::get('preview',[OpenRateController::class,function(){return view('unsubscribe');}]);
Route::get('/unsubscribe/{email}',[OpenRateController::class, 'unsubscribe'])->name('unsubscribe');
Route::post('/unsubscribe',[OpenRateController::class, 'unsubscribe'])->name('unsubscribeAjax');


Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/', function () { return view('dashboard'); })->name('dashboard');

    Route::get('/previous-campaigns',[IndexController::class, 'previous_campaigns'])->name('previousCampaigns');
    Route::get('/previous-campaigns/{id}/details',[IndexController::class, 'previous_campaigns_details'])->whereNumber('id')->name('previousCampaignsDetails');
    Route::post('/get-data', [IndexController::class,'get_data'])->name('getData');
    Route::post('/stop-campaign', [IndexController::class,'stop_campaign'])->name('stopCampaign');

    Route::get('/mailing-list',[IndexController::class, 'mail_list'])->name('mailList');
    Route::post('/single-row',[IndexController::class, 'single_row'])->name('getSingleMail');

    Route::get('/send-newsletter/{id}/single',[BulkMailerController::class,'singleEmail'])->whereNumber('id')->name('singleEmail');
    Route::post('/send-newsletter-single',[BulkMailerController::class,'singleEmail'])->name('SendSingleEmail');

    Route::get('/send-newsletter',[BulkMailerController::class,'index'])->name('sendMail');
    Route::post('/bulkMailers',[BulkMailerController::class,'store'])->name('sendMailPost');
    Route::post('/ajax/mail-data-update',[BulkMailerController::class,'update'])->name('sendMailData');

    Route::get('/add-person',[IndexController::class, 'add_person'])->name('addPerson');
    Route::post('/add-person',[BulkMailerController::class, 'add_person_post'])->name('addPersonPost');

    Route::get('/bulk-file-upload',[IndexController::class, 'bulkUpload'])->name('bulkUpload');
    Route::post('/bulk-file-upload',[BulkMailerController::class, 'bulkUpload'])->name('forms.store.bulk');

    Route::get('/add-emails',[IndexController::class, 'add_emails'])->name('addEmails');
    Route::post('/upload-emails',[BulkMailerController::class,'create'])->name('uploadeMails');

    Route::get('/bulkMailers/{id}/delete',[BulkMailerController::class,'destroy'])->name('deleteEmail');
    Route::get('/deleted-emails',[BulkMailerController::class,'showDeleted'])->name('deletedEmails');
    Route::get('/restore-emails/{id}/restore',[BulkMailerController::class,'restore'])->name('restoreEmail');

    // Working Perfect
    // Route::get('/test', function(){
    //     Artisan::call('queue:clear');
    // });
});

require __DIR__.'/auth.php';
