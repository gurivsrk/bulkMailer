<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

use App\Mail\Newsletter;
use App\Models\bulkMailer;
use App\Models\testEmails;

use Exception;

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 999;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        testEmails::where('status','!=','-')->update(['status'=>'-']);

         $emails = testEmails::select('email','id')->where('status','-')->get();

         $daily_limit = 490
         ;
         $counter = 0;
         $no_of_acc = 2;
         $smtp = 1;
         $perHour = ($daily_limit * $no_of_acc) / 24;
         $timeDelay = round(3600/ $perHour);

        foreach($emails as $key=>$email){

            if($counter == $daily_limit){
                $counter =1 ;
                ++$smtp;
                if($no_of_acc < $smtp){
                    $smtp = 1;
                }
            }

            SendNewsletterWithDelay::dispatch($email->email,$this->request,$email->id,$smtp,$timeDelay)->delay(now()->addSeconds(1));
            $counter++ ;
        }
    }
}
