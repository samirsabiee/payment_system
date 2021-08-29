<?php namespace App\Services\Notification;

use App\Services\Contracts\Provider;

class Notification
{
    public function send(Provider $provider)
    {
        $provider->send();
    }
}
