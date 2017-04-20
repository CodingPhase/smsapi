<?php

namespace CodingPhase\SMSApi;

use CodingPhase\SMSApi\Exceptions\CouldNotSendNotification;
use SMSApi\Exception\SmsapiException;
use Illuminate\Notifications\Notification;

class SMSApiChannel
{
    protected $smsapi;

    /**
     * SMSApiChannel constructor.
     * @param SMSApi $smsapi
     */
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
     * @throws \CodingPhase\SMSApi\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSMSApi($notifiable);

        if (! $message->to) {
            $phoneNumber = $notifiable->getUserPhoneNumber();
            if (empty($phoneNumber)) {
                $message->to();
                throw CouldNotSendNotification::missingRecipient();
            }
        }

        try {
            $this->smsapi->send($message);
        } catch (SmsapiException $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }
    }
}
