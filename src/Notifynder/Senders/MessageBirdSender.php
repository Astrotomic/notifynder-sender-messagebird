<?php

namespace Astrotomic\Notifynder\Senders;

use MessageBird\Client;
use Fenos\Notifynder\Builder\Notification;
use Fenos\Notifynder\Traits\SenderCallback;
use Fenos\Notifynder\Contracts\SenderContract;
use Fenos\Notifynder\Contracts\SenderManagerContract;

abstract class MessageBirdSender implements SenderContract
{
    use SenderCallback;

    /**
     * @var array
     */
    protected $notifications;

    /**
     * @var array
     */
    protected $config;

    /**
     * MessageBirdSender constructor.
     *
     * @param array $notifications
     */
    public function __construct(array $notifications)
    {
        $this->notifications = $notifications;
        $this->config = notifynder_config('senders.messagebird');
    }

    public function send(SenderManagerContract $sender)
    {
        $accessKey = $this->config['access_key'];
        $store = $this->config['store'];
        $client = new Client($accessKey);
        foreach ($this->notifications as $notification) {
            $this->sendMessage($client, $notification);
        }

        if ($store) {
            return $sender->send($this->notifications);
        }

        return true;
    }

    abstract protected function sendMessage(Client $client, Notification $notification);
}
