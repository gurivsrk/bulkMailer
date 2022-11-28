<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

use App\Mail\Newsletter;
use App\Models\testEmails;
use App\Models\bulkMailer;
use App\Models\newsletterMetal;

class SendNewsletterWithDelay implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 999;

    private $email,
    $request,
    $id,
    $time_delay,
    $smtp,
    $email_count,
    $total_send,
    $newNewsletter,
    $newslettermeta;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$request,$id,$smtp,$timeDelay,$emailCount, $totalSend, $newNewsletter,$newslettermeta)
    {
        $this->email = $email;
        $this->request = $request;
        $this->id = $id;
        $this->smtp = $smtp;
        $this->time_delay =$timeDelay;
        $this->email_count =$emailCount;
        $this->total_send =$totalSend;
        $this->newNewsletter =$newNewsletter;
        $this->newslettermeta = $newslettermeta;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $fromName = $this->request['from_name'];
        $title = $this->request['title'];
        $message = $this->request['newsletter'];
        $this->id =='NA' ?'':bulkMailer::where('id',$this->id)->update(['status'=>'sending']);

        sleep($this->time_delay);

        if($this->smtp == 1){
             Mail::to($this->email)->send(new Newsletter( $fromName, $title, $message ));
        }
        else{
            $ss = 'smtp'.$this->smtp;
            Mail::mailer($ss)->to($this->email)->send(new Newsletter( $fromName, $title, $message ));
        }

        $this->id =='NA' ?'':bulkMailer::where('id',$this->id)->update(['status'=>'success']);

        $this->newslettermeta->update(['send_emails' => $this->total_send]);

        if($this->email_count == $this->total_send){
            bulkMailer::where('status','!=','-')->update(['status'=>'-']);
            $this->newNewsletter->update(['status'=>'completed']);
        }
    }
}
