<?php

namespace Astrotomic\Notifynder\Senders;

use Fenos\Notifynder\Builder\Notification;
use Fenos\Notifynder\Contracts\SenderContract;
use Fenos\Notifynder\Contracts\SenderManagerContract;
use MessageBird\Client;

abstract class MessageBirdSender implements SenderContract
{
    /**
     * @var array
     */
    protected $notifications;

    /**
     * MessageBirdSmsSender constructor.
     *
     * @param array $notifications
     */
    public function __construct(array $notifications)
    {
        $this->notifications = $notifications;
    }

    public function send(SenderManagerContract $sender)
    {
        $accessKey = config('notifynder.senders.messagebird.access_key');
        $store = config('notifynder.senders.messagebird.store', false);
        $client = new Client($accessKey);
        foreach ($this->notifications as $notification) {
            $message = $this->getMessage($notification);
            $client->messages->create($message);
        }

        if ($store) {
            return $sender->send($this->notifications);
        }

        return true;
    }

    abstract protected function getMessage(Notification $notification);
}
