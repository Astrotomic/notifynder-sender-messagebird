<?php

namespace Astrotomic\Notifynder\Senders;

use Astrotomic\Notifynder\Senders\Messages\SmsMessage;
use MessageBird\Client;
use MessageBird\Objects\Message;
use Fenos\Notifynder\Builder\Notification;

class MessageBirdSmsSender extends MessageBirdSender
{
    protected function sendMessage(Client $client, Notification $notification)
    {
        $callback = config('notifynder.senders.messagebird.callbacks.sms');
        $sms = call_user_func($callback, new SmsMessage(), $notification);
        $message = new Message();
        $message->originator = $sms->getOriginator();
        $message->recipients = [$sms->getRecipient()];
        $message->body = $sms->getBody();
        $client->messages->create($message);
    }
}
