<?php

namespace NotificationChannels\SMSApi;

use NotificationChannels\SMSApi\Exceptions\CouldNotSendNotification;
use NotificationChannels\SMSApi\Events\MessageWasSent;
use NotificationChannels\SMSApi\Events\SendingMessage;
use Illuminate\Notifications\Notification;

class SMSApiChannel
{
    public function __construct()
    {
        // Initialisation code here
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
        //$response = [a call to the api of your notification send]

//        if ($response->error) { // replace this by the code need to check for errors
//            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
//        }
    }
}
