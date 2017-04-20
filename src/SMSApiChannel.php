<?php

namespace NotificationChannels\SMSApi;

use NotificationChannels\SMSApi\Exceptions\CouldNotSendNotification;
use SMSApi\Exception\SmsapiException;
use NotificationChannels\SMSApi\Events\MessageWasSent;
use NotificationChannels\SMSApi\Events\SendingMessage;
use Illuminate\Notifications\Notification;

class SMSApiChannel
{
    protected $smsapi;

    public function __construct(SMSApi $smsapi)
    {
        $this->smsapi = $smsapi;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\SMSApi\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSMSApi($notifiable);

        if($message->to) {
            $message->to($notifiable->getUserPhoneNumber());
        }

        try {
            $response = $this->smsapi->send($message);

            foreach ($response->getList() as $status) {
                echo $status->getNumber() . ' ' . $status->getPoints() . ' ' . $status->getStatus();
            }
        } catch (SmsapiException $exception) {
            echo 'ERROR: ' . $exception->getMessage();
        }


        //$response = [a call to the api of your notification send]

//        if ($response->error) { // replace this by the code need to check for errors
//            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
//        }
    }
}
