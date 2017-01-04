<?php

namespace Astrotomic\Notifynder;

use Astrotomic\Notifynder\Senders\MessageBirdSmsSender;
use Astrotomic\Notifynder\Senders\MessageBirdVoiceSender;
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
        app('notifynder')->extend('sendMessageBirdVoice', function (array $notifications) {
            return new MessageBirdVoiceSender($notifications);
        });
    }
}
