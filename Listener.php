<?php

namespace Notifications;

use Notifications\Entity\User;
use Notifications\Event\Event;

/**
 * Main event handler. Receives Events and notifies subscribed Users.
 */
class Listener
{
    public function handleEvent(Event $event)
    {
        //not very efficient...if we used DB storage, we could filter by certain criteria
        $users = User::findAll();

        /* @var $user User */
        foreach ($users as $user)
        {
            if ($user->isSubscribedToEvent($event))
            {
                $user->getNotificationStrategy()->notify($user, $event);
            }
        }
    }
}