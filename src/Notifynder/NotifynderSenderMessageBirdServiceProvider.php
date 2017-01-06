<?php

namespace Astrotomic\Notifynder;

use Illuminate\Support\ServiceProvider;
use Astrotomic\Notifynder\Senders\MessageBirdSmsSender;
use Astrotomic\Notifynder\Senders\MessageBirdCallSender;

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
