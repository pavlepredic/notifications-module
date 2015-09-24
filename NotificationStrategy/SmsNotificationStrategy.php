<?php

namespace Notifications\NotificationStrategy;

use Notifications\Event\Event;
use Notifications\Entity\Template\SmsTemplate;
use Notifications\Entity\User;

/**
 * An implementation of NotificationStrategy that sends notifications via SMS.
 */
class SmsNotificationStrategy extends NotificationStrategy
{
    public function notify(User $user, Event $event)
    {
        if ($user->getPhone())
        {
            /* @var $template SmsTemplate */
            //we know it's a SmsTemplate, because we asked for it by type
            $template = $this->getTemplate($user, $event, new SmsTemplate());

            echo "Sending SMS to " . $user->getPhone() . ":\n";
            echo $template->getText() . "\n\n";

            //we would probably have an API for sending SMS which we would call here...
        }
    }
}