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
use App\Models\bulkMailer;
use App\Models\SendingMail;

class SendNewsletterWithDelay implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 999;

    private $email,
    $request,
    $id,
    $time_delay,
    $daily_limit,
    $email_count,
    $no_of_acc,
    $newNewsletter,
    $newslettermeta;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$request,$id,$daily_limit, $no_of_acc, $emailCount, $timeDelay, $newNewsletter,$newslettermeta)
    {
        $this->email = $email;
        $this->request = $request;
        $this->id = $id;
        $this->daily_limit = $daily_limit;
        $this->time_delay =$timeDelay;
        $this->email_count = $emailCount;
        $this->no_of_acc =$no_of_acc;
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

        $counter = 0;
        $smtp = 1;

         if($counter == $this->daily_limit){
            $counter = 1 ;
            ++$smtp;
            if($this->no_of_acc < $smtp){
                $smtp = 1;
            }
        }

        $fromName = $this->request['from_name'];
        $title = $this->request['title'];
        $message = $this->request['newsletter'];
        $this->id =='NA' ?'':bulkMailer::where('id',$this->id)->update(['status'=>'sending']);

        sleep($this->time_delay);

        $ss = ($smtp == 1) ? 'smtp': 'smtp'.$smtp;

        Mail::mailer($ss)->to($this->email)->send(new Newsletter( $fromName, $title, $message, $this->email ));

        $this->id =='NA' ?'':bulkMailer::where('id',$this->id)->update(['status'=>'success']);

        $sending = SendingMail::create([
            'email'=>$this->email,
            'campaign_id' =>$this->newNewsletter->id
        ]);

        $counter = $sending->where('campaign_id',$this->newNewsletter->id)->count();

        $this->newslettermeta->update(['send_emails' => $counter]);

        if($this->email_count == $counter){
            bulkMailer::where('status','!=','-')->update(['status'=>'-']);
            $this->newNewsletter->update(['status'=>'completed']);
            //SendingMail::truncate();
        }
    }
}
