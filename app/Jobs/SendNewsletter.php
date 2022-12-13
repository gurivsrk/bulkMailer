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
use App\Models\newsletterMeta;


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
    public function handle(\App\Models\newsletter $newsletter, bulkMailer $bulkMailer)
    {
        $daily_limit = 490;
        $no_of_acc = 6;
        $perHour = ($daily_limit * $no_of_acc) / 24;
        $timeDelay = round(3600/ $perHour);

        $smtp=1;

        $counter = 1;

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
                $emails = $bulkMailer->Subscribed()->get();
            }
            else{
                $emails = $bulkMailer->Subscribed()->whereIn('category_id',$categies)->get();
            }
            $mass = false;
        }
        else{
            $emails = $categies;
            $mass = true;
        }

        $bulkMailer->where('status','!=','-')->Subscribed()->update(['status'=>'-']);

        // $emails = testEmails::select('email','id')->where('status','-')->get();

        $cate =  in_array(-12,$categies) ? 'all' : json_encode($categies);

         $newslettermeta = newsletterMeta::create([
            'campaign_id' =>  $newNewsletter->id,
            'categories_id' =>$cate,
            'total_emails' => count($emails)
         ]);

        foreach($emails as $email){

            $id = $mass == true ? 'NA' : $email->id;
            if($id != 'NA'){
                $bulkMailer->where('id',$id)->update(['status'=>'waiting']);
             }
        }

        foreach($emails as $email){

            if($daily_limit == $counter){
                ++$smtp;
                $counter = 1 ;
                if($no_of_acc < $smtp){
                    $smtp = 1;
                }
            }
            $emailID = $mass == true ? $email : $email->email;
            $id = $mass == true ? 'NA' : $email->id;
            SendNewsletterWithDelay::dispatch($emailID,$this->request,$id,$daily_limit,$no_of_acc, count($emails),$timeDelay,$newNewsletter,$newslettermeta, $smtp,$counter);
            $counter++;
        }
    }
}
