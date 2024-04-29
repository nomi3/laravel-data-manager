<?php

namespace App\Usecases\Insured;

use App\Mail\InsuredInformation;
use App\Models\Insured;
use Illuminate\Support\Facades\Mail;

class SendEmails
{
    public function __invoke()
    {
        $insureds = Insured::whereNotNull('email')->get();
        foreach ($insureds as $insured) {
            Mail::to($insured->email)->send(new InsuredInformation($insured));
        }
    }
}
