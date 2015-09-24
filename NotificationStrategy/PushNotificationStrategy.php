<?php

namespace Notifications\NotificationStrategy;

use Notifications\Event\Event;
use Notifications\Entity\Template\PushNotificationTemplate;
use Notifications\Entity\User;

/**
 * An implementation of NotificationStrategy that sends notifications via push notifications.
 */
class PushNotificationStrategy extends NotificationStrategy
{
    public function notify(User $user, Event $event)
    {
        if ($user->getPhone())
        {
            /* @var $template PushNotificationTemplate */
            //we know it's a PushNotificationTemplate, because we asked for it by type
            $template = $this->getTemplate($user, $event, new PushNotificationTemplate());

            echo "Sending push notification to " . $user->getPhone() . ":\n";
            echo $template->getText() . "\n\n";

            //we would probably have an API for sending push notifications which we would call here...
        }
    }
}