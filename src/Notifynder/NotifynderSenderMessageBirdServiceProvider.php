<?php

namespace Astrotomic\Notifynder;

use Astrotomic\Notifynder\Senders\MessageBirdCallSender;
use Astrotomic\Notifynder\Senders\MessageBirdSmsSender;
use Illuminate\Support\ServiceProvider;

class NotifynderSenderMessageBirdServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        app('notifynder')->extend('sendMessageBirdSms', function (array $notifications) {
            return new MessageBirdSmsSender($notifications);
        });
        app('notifynder')->extend('sendMessageBirdCall', function (array $notifications) {
            return new MessageBirdCallSender($notifications);
        });
    }
}
