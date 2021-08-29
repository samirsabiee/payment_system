<?php namespace App\Services\Providers;

use App\Models\User;
use App\Services\Contracts\Provider;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements Provider
{
    private Mailable $mailable;
    private User $user;

    public function __construct(User $user, Mailable $mailable)
    {
        $this->user = $user;
        $this->mailable = $mailable;
    }

    public function send()
    {
        Mail::to($this->user)->send($this->mailable);
    }
}
