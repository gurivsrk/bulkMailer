<?php

namespace App\Traits;
use App\Jobs\SendNewsletter;

trait SendMail {

    public function Email($request)
    {
        $job = SendNewsletter::dispatch($request);
    }

}
