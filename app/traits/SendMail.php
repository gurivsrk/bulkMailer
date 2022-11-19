<?php

namespace App\Traits;

use App\Jobs\SendNewsletter;
use App\Jobs\SendNewsletterWithDelay;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

use App\Mail\Newsletter;
use App\Models\bulkMailer;
use App\Models\testEmails;

use Exception;
trait SendMail {

    protected function Email($request)
    {
        $job = SendNewsletter::dispatch($request);
        // echo "Mail send successfully !!";
    }

}
