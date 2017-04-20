<?php

namespace NotificationChannels\SMSApi;

use SMSApi\Client;
use SMSApi\Api\SmsFactory;
use SMSApi\Exception\SmsapiException;
use NotificationChannels\SMSApi\Exceptions\CouldNotSendNotification;
use NotificationChannels\SMSApi\Events\MessageWasSent;
use NotificationChannels\SMSApi\Events\SendingMessage;
use Illuminate\Notifications\Notification;

class SMSApi
{
    protected $smsFactory;

    public function __construct($token)
    {
        $this->smsFactory = new SmsFactory();
        $client = Client::createFromToken($token);
        $this->smsFactory->setClient($client);
    }

    public function send(SMSApiMessage $message)
    {
        $actionSend = $this->smsFactory->actionSend();

        $actionSend->setTo($message->to);
        $actionSend->setText($message->content);
        $actionSend->setSender('Info');

        return $actionSend->execute();
    }

}
