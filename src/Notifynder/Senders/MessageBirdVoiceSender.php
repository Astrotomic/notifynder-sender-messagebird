<?php

namespace Astrotomic\Notifynder\Senders;

use Fenos\Notifynder\Builder\Notification;
use MessageBird\Objects\VoiceMessage;

class MessageBirdVoiceSender extends MessageBirdSender
{
    protected function getMessage(Notification $notification)
    {
        $callback = config('notifynder.senders.messagebird.callbacks.voice');
        $message = call_user_func($callback, new VoiceMessage(), $notification);
        if (empty($message->body)) {
            $message->body = $notification->getText();
        }
        return $message;
    }
}
