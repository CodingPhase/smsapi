<?php

namespace CodingPhase\SMSApi;

use SMSApi\Client;
use SMSApi\Api\SmsFactory;

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
        $actionSend->setSender($message->from);

        return $actionSend->execute();
    }

}
