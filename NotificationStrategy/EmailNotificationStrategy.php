<?php

namespace Notifications\NotificationStrategy;

use Notifications\Event\Event;
use Notifications\Entity\Template\MailTemplate;
use Notifications\Entity\User;

/**
 * An implementation of NotificationStrategy that sends notifications via email.
 */
class EmailNotificationStrategy extends NotificationStrategy
{
    public function notify(User $user, Event $event)
    {
        if ($user->getEmail())
        {
            /* @var $template MailTemplate */
            //we know it's a MailTemplate, because we asked for it by type
            $template = $this->getTemplate($user, $event, new MailTemplate());

            /* In a real world application a more sophisticated
             * mailing mechanism would be used. For the purposes
             * of this exercise, I'm using the most primitive method.
             */
            echo "Sending mail to " . $user->getEmail() . ":\n";
            echo $template->getSubject() . "\n";
            echo $template->getText() . "\n\n";
            //mail($user->getEmail(), $template->getSubject(), $template->getBody());
        }
    }
}