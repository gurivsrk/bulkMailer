<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


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
    public function handle(\App\Models\newsletter $newsletter)
    {
        $daily_limit = 490;
         $counter = 0;
         $no_of_acc = 6;
         $smtp = 1;
         $perHour = ($daily_limit * $no_of_acc) / 24;
         $timeDelay = round(3600/ $perHour);

         $totalSend = 1;

        $categies = $this->request['category_name'];
        $isNum= '';
        $fromName = $this->request['from_name'];
        $title = $this->request['title'];
        $message = $this->request['newsletter'];
        $mass = false;

        foreach($categies as $r){
            $isNum =   is_numeric($r);
        }
        $newNewsletter =  $newsletter->create([
            'from_name' => $fromName,
            'from_email' => env('MAIL_USERNAME'),
            'Subject' => $title,
            'newsletter' => $message,
            'status' => 'sending'
        ]);

        if($isNum){
            if(in_array(-12,$categies)){
                $emails = bulkMailer::Subscribed()->get();
            }
            else{
                $emails = bulkMailer::Subscribed()->whereIn('category_id',$categies)->get();
            }
            $mass = false;
        }
        else{
            $emails = $categies;
            $mass = true;
        }

         bulkMailer::where('status','!=','-')->update(['status'=>'-']);

        //  $emails = testEmails::select('email','id')->where('status','-')->get();


        foreach($emails as $email){

            $emailID = $mass == true ? $email : $email->email;
            $id = $mass == true ? 'NA' : $email->id;

            $id != 'NA' ?'':bulkMailer::where('id',$id)->update(['status'=>'sending']);
            if($id != 'NA'){
               $next = $id + 1;
               bulkMailer::where('id',$next)->update(['status'=>'waiting']);
            }

            if($counter == $daily_limit){
                $counter =1 ;
                ++$smtp;
                if($no_of_acc < $smtp){
                    $smtp = 1;
                }
            }

                SendNewsletterWithDelay::dispatch($emailID,$this->request,$id,$smtp,$timeDelay,count($emails),$totalSend,$newNewsletter)->delay(now()->addSeconds(1));
            $counter++ ;
            $totalSend++;
        }


    }
}
