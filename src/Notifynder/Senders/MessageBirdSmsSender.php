<?php

namespace Astrotomic\Notifynder\Senders;

use Fenos\Notifynder\Builder\Notification;
use MessageBird\Objects\Message;

class MessageBirdSmsSender extends MessageBirdSender
{
    protected function getMessage(Notification $notification)
    {
        $callback = config('notifynder.senders.messagebird.callbacks.sms');
        $message = call_user_func($callback, new Message(), $notification);
        if (empty($message->body)) {
            $message->body = $notification->getText();
        }
        return $message;
    }
}
