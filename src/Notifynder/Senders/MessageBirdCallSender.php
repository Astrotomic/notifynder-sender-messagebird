<?php

namespace Astrotomic\Notifynder\Senders;

use MessageBird\Client;
use MessageBird\Objects\VoiceMessage;
use Fenos\Notifynder\Builder\Notification;
use Astrotomic\Notifynder\Senders\Messages\CallMessage;

class MessageBirdCallSender extends MessageBirdSender
{
    protected function sendMessage(Client $client, Notification $notification)
    {
        $callback = $this->getCallback();
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
