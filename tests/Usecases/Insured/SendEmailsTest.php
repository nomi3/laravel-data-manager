<?php

namespace Tests\Usecases\Insured;

use App\Mail\InsuredInformation;
use App\Models\Insured;
use App\Usecases\Insured\SendEmails;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendEmailsTest extends TestCase
{
    public function testInvoke()
    {
        Mail::fake();
        $insured = Insured::factory()->create();
        $usecase = new SendEmails();
        $usecase();
        Mail::assertSent(InsuredInformation::class, function (InsuredInformation $mail) use ($insured) {
            return $mail->hasTo($insured->email);
        });
    }

    public function testInvokeWithNoEmail()
    {
        Mail::fake();
        Insured::factory()->create(['email' => null]);
        $usecase = new SendEmails();
        $usecase();
        Mail::assertNothingSent();
    }
}
