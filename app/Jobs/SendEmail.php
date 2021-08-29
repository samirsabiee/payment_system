<?php

namespace App\Jobs;

use App\Mail\OrderShipped;
use App\Services\Notification\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private \App\Services\Providers\SendEmail $sendEmail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Services\Providers\SendEmail $sendEmail)
    {
        $this->sendEmail = $sendEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Notification $notification)
    {
        $notification->send($this->sendEmail);
    }
}
