<?php

namespace Astrotomic\Notifynder\Senders;

use Astrotomic\Notifynder\Senders\Messages\CallMessage;
use MessageBird\Client;
use MessageBird\Objects\VoiceMessage;
use Fenos\Notifynder\Builder\Notification;

class MessageBirdCallSender extends MessageBirdSender
{
    protected function sendMessage(Client $client, Notification $notification)
    {
        $callback = config('notifynder.senders.messagebird.callbacks.call');
        $call = call_user_func($callback, new CallMessage(), $notification);
        $message = new VoiceMessage();
        $message->originator = $call->getOriginator();
        $message->recipients = [$call->getRecipient()];
        $message->body = $call->getBody();
        $message->language = $call->getLanguage();
        $message->voice = $call->getGender();
        $client->voicemessages->create($message);
    }
}
