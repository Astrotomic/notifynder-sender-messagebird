# Notifynder 4 MessageBird Sender - Laravel 5

[![GitHub release](https://img.shields.io/github/release/astrotomic/notifynder-sender-messagebird.svg?style=flat-square)](https://github.com/astrotomic/notifynder-sender-messagebird/releases)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/astrotomic/notifynder-sender-messagebird/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/astrotomic/notifynder-sender-messagebird.svg?style=flat-square)](https://github.com/astrotomic/notifynder-sender-messagebird/issues)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/notifynder-sender-messagebird.svg?style=flat-square)](https://packagist.org/packages/astrotomic/notifynder-sender-messagebird)

[![StyleCI](https://styleci.io/repos/78019088/shield)](https://styleci.io/repos/78019088)

[![Code Climate](https://img.shields.io/codeclimate/github/Astrotomic/notifynder-sender-messagebird.svg?style=flat-square)](https://codeclimate.com/github/Astrotomic/notifynder-sender-messagebird)

[![Slack Team](https://img.shields.io/badge/slack-astrotomic-orange.svg?style=flat-square)](https://astrotomic.slack.com)
[![Slack join](https://img.shields.io/badge/slack-join-green.svg?style=social)](https://notifynder.signup.team)


Documentation: **[Notifynder Docu](http://notifynder.info)**

-----

## Installation

### Step 1

```
composer require astrotomic/notifynder-sender-messagebird
```

### Step 2

Add the following string to `config/app.php`

**Providers array:**

```
Astrotomic\Notifynder\NotifynderSenderMessageBirdServiceProvider::class,
```

### Step 3

Add the following array to `config/notifynder.php`

```php
'senders' => [
    'messagebird' => [
        'access_key' => '',
        'callbacks' => [
            // https://developers.messagebird.com/start
            // https://github.com/messagebird/php-rest-api
            // you don't have to set the message text, by default (if empty) it is set in the sender itself
            // just return the message, don't send it - otherwise you will get the message two times
            'sms' => function(\MessageBird\Objects\Message $message, \Fenos\Notifynder\Models\Notification $notification) {
                // handle the message and append the from, to and so on
                return $message;
            },
            'voice' => function(\MessageBird\Objects\VoiceMessage $message, \Fenos\Notifynder\Models\Notification $notification) {
                // handle the message and append the from, to and so on
                return $message;
            },
        ],
        'store' => false, // wether you want to also store the notifications in database
    ],
],
```