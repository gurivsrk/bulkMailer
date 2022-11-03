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

use Exception;

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;

    public $timeout = 7200;

    public $failOnTimeout = true;

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
        $isNum= '';
        $fromName = $this->request['from_name'];
        $title = $this->request['title'];
        $message = $this->request['newsletter'];
        $categies = $this->request['category_name'];


        $emailCount = 0;

        $newNewsletter =  $newsletter->create([
            'from_name' => $fromName,
            'from_email' => env('MAIL_USERNAME'),
            'Subject' => $title,
            'newsletter' => $message,
            'status' => 'sending'
        ]);

            foreach($categies as $r){
                $isNum =   is_numeric($r);
            }

            if($isNum){
                if(in_array(-12,$categies)){
                    $emails = bulkMailer::select('email')->orderBy('id','desc')->get();
                }
                else{
                    $emails = bulkMailer::select('email')->whereIn('category_id',$categies)->get();
                }
            }
            else{
                $emails = $categies;
            }

        // foreach($emails as $email){
        //     bulkMailer::where('email',$email)->update(['status'=>'sending']);
        //     try{
        //         $mail = Mail::to($email)->send(new Newsletter( $fromName, $title, $message ));
        //         bulkMailer::where('email',$email)->update(['status'=>'success']);
        //     }catch(Exception $err){
        //         bulkMailer::where('email',$email)->update(['status'=>'fail']);
        //     }
        //     $emailCount++ ;
        // }
        // if($emailCount == count($emails)){
        //     echo $emailCount .'== '.count($emails);
        //     dd('equal');
        // }
        // else{
        //     echo $emailCount .'== '.count($emails);
        //     dd('no');
        // }

        for($i=0;$i<200;$i++){
            Mail::to('gursharan@vsrkcapital.com')->send(new Newsletter( $fromName, $title, $message ));
        }

        //$newNewsletter->update('status','completed');
    }
}
