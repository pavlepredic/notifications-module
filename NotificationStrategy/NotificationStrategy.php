<?php

namespace Notifications\NotificationStrategy;

use Notifications\Event\Event;
use Notifications\Entity\Template\Template;
use Notifications\Entity\User;

/**
 * Base class for various notification strategies
 */
abstract class NotificationStrategy
{
    abstract public function notify(User $user, Event $event);

    protected function getTemplate(User $user, Event $event, Template $type)
    {
        /* @var $template Template */
        $template = $event->getTemplateByType($type);
        $template->setVariable('user', $user);
        $template->setVariables($event->getTemplateVariables());
        return $template;
    }
}