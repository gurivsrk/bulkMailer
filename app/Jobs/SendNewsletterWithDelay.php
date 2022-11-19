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

class SendNewsletterWithDelay implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 999;

    private $email,$request,$id,$time_delay,$smtp;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$request,$id,$smtp,$timeDelay)
    {
        $this->email = $email;
        $this->request = $request;
        $this->id = $id;
        $this->smtp = $smtp;
        $this->time_delay =$timeDelay;
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
        sleep($this->time_delay);
        if($this->smtp == 1){
             Mail::to($this->email)->send(new Newsletter( $fromName, $title, $message ));
        }
        else{
            $ss = 'smtp'.$this->smtp;
            Mail::mailer($ss)->to($this->email)->send(new Newsletter( $fromName, $title, $message ));
        }
        testEmails::where('id',$this->id)->update(['status'=>'send']);
    }
}
