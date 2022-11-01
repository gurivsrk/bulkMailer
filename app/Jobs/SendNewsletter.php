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

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $fromName = $this->request['from_name'];
        $fromEmail = $this->request['from_email'];
        $title = $this->request['title'];
        $message = $this->request['newsletter'];
        $categies = $this->request['category_name'];

        if(in_array('all',$categies)){
            $emails = bulkMailer::select('email')->orderBy('id','desc')->get();
        }
        else{
            $emails = bulkMailer::select('email')->whereIn('category_id',$categies)->get();
        }

        foreach($emails as $email){
            Mail::to($email)->send(new Newsletter( $fromName, $fromEmail ,$title, $message ));
        }
    }
}
