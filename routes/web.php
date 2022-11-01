<?php

use Illuminate\Support\Facades\Route;
use Illuminate\http\Request;
use App\Http\Controllers\BulkMailerController;
use App\Http\Controllers\IndexController;
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
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/send-newsletter/single/{id}',function(){return view('newsletter');})->name('singleEmail');
    Route::get('/previous-campaigns',[IndexController::class, 'previous_campaigns'])->name('previousCampaigns');
    Route::get('/add-emails',[IndexController::class, 'add_emails'])->name('addEmails');
    Route::get('/mailing-list',[IndexController::class, 'mail_list'])->name('mailList');
    Route::get('/send-newsletter',[BulkMailerController::class,'index'])->name('sendMail');
    Route::post('/upload-emails',[BulkMailerController::class,'create'])->name('uploadeMails');
    Route::post('/bulkMailers',[BulkMailerController::class,'store'])->name('sendMailPost');
});

require __DIR__.'/auth.php';