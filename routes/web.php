<?php

use Illuminate\Support\Facades\Route;
use Illuminate\http\Request;
use App\Http\Controllers\BulkMailerController;
use App\Http\Controllers\OpenRateController;
use App\Http\Controllers\IndexController;
use App\Models\bulkMailer;

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

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/previous-campaigns',[IndexController::class, 'previous_campaigns'])->name('previousCampaigns');
    Route::get('/mailing-list',[IndexController::class, 'mail_list'])->name('mailList');



    Route::get('/send-newsletter/{id}/single',[BulkMailerController::class,'singleEmail'])->whereNumber('id')->name('singleEmail');
    Route::get('/send-newsletter',[BulkMailerController::class,'index'])->name('sendMail');
    Route::post('/bulkMailers',[BulkMailerController::class,'store'])->name('sendMailPost');
    Route::post('/ajax/mail-data-update',[BulkMailerController::class,'update'])->name('sendMailData');

    Route::get('/add-emails',[IndexController::class, 'add_emails'])->name('addEmails');
    Route::post('/upload-emails',[BulkMailerController::class,'create'])->name('uploadeMails');

    Route::get('/bulkMailers/{id}/delete',[BulkMailerController::class,'destroy'])->name('deleteEmail');
    Route::get('/deleted-emails',[BulkMailerController::class,'showDeleted'])->name('deletedEmails');
    Route::get('/restore-emails/{id}/restore',[BulkMailerController::class,'restore'])->name('restoreEmail');

    // Test email opening

    Route::get('/image/{newsletter_id}/show',[OpenRateController::class, 'showImage'])->name('emailImage');

});

require __DIR__.'/auth.php';
