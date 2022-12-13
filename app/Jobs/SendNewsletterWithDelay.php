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
    $newslettermeta,
    $smtp,
    $counter;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$request,$id,$daily_limit, $no_of_acc, $emailCount, $timeDelay, $newNewsletter,$newslettermeta,$smtp,$counter)
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
        $this->smtp = $smtp;
        $this->counter = $counter;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mail $mail, bulkMailer $bulkMailer)
    {

        $fromName = $this->request['from_name'];
        $title = $this->request['title'];
        $message = $this->request['newsletter'];
        $this->id =='NA' ?'':$bulkMailer->where('id',$this->id)->update(['status'=>'sending']);

        sleep(5);

        $ss = ($this->smtp == 1) ? 'smtp': 'smtp'.$this->smtp;

    //    $mail->mailer($ss)->to($this->email)->send(new Newsletter( $fromName, $title, $message, $this->email ));

        $this->id =='NA' ?'':$bulkMailer->where('id',$this->id)->update(['status'=>'success']);

        $sending = SendingMail::create([
            'email'=>$this->email,
            'campaign_id' =>$this->newNewsletter->id,
            'smtp' =>$this->smtp.'-counter--'.$this->counter.'--Daily--'.$this->daily_limit.'--acc--'.$this->no_of_acc
        ]);

        $counter = $sending->where('campaign_id',$this->newNewsletter->id)->count();

        $this->newslettermeta->update(['send_emails' => $counter]);

        if($this->email_count == $counter){
            $bulkMailer->where('status','!=','-')->update(['status'=>'-']);
            $this->newNewsletter->update(['status'=>'completed']);
            //SendingMail::truncate();
        }

    }
}
