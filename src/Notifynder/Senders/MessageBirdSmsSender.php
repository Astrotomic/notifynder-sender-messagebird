<?php

namespace Astrotomic\Notifynder\Senders;

use MessageBird\Client;
use MessageBird\Objects\Message;
use Fenos\Notifynder\Builder\Notification;
use Astrotomic\Notifynder\Senders\Messages\SmsMessage;

class MessageBirdSmsSender extends MessageBirdSender
{
    protected function sendMessage(Client $client, Notification $notification)
    {
        $callback = $this->getCallback();
        $sms = call_user_func($callback, new SmsMessage(), $notification);
        $message = new Message();
        $message->originator = $sms->getOriginator();
        $message->recipients = [$sms->getRecipient()];
        $message->body = $sms->getBody();
        $client->messages->create($message);
    }
}
