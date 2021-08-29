<?php namespace App\Services\Providers;

use App\Models\User;
use App\Services\Contracts\Provider;
use App\Services\Notification\DoseNotHavePhoneNumber;
use IPPanel\Client;
use IPPanel\Errors\Error;
use IPPanel\Errors\HttpException;

class SendSms implements Provider
{

    private string $message;
    private User $user;

    public function __construct(User $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function send()
    {
        $client = new Client(config('services.sms.apiKey'));

        $this->havePhoneNumber();
        try {
            ['originator' => $originator, 'recipients' => $recipients, 'message' => $message] = $this->prepareSmsData();
            $bulkId = $client->send($originator, $recipients, $message);
        } catch (Error | HttpException $e) {
            dd($e->getMessage());
        }

    }

    private function prepareSmsData(): array
    {
        return [
            'originator' => config('services.sms.originator'),
            'recipients' => [$this->user->phone_number,],
            'message' => $this->message,
        ];
    }

    /**
     * @throws DoseNotHavePhoneNumber
     */
    private function havePhoneNumber()
    {
        if (is_null($this->user->phone_number)) {
            throw new DoseNotHavePhoneNumber();
        }
    }

    public function setHeader(): array
    {
        return ['headers' => [
            'Authorization' => 'AccessKey ' . config('services.sms.apiKey')
        ]];
    }
}
