<?php

namespace App\Traits;

use App\Jobs\SendNewsletter;
trait SendMail {

    protected function Email($request)
    {
        $job = SendNewsletter::dispatch($request);
        // echo "Mail send successfully !!";
    }

}
