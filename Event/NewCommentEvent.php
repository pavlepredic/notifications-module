<?php

namespace Notifications\Event;

/**
 * Represents an event that is triggered when a new comment is posted.
 */
class NewCommentEvent extends Event
{
    public function setPage($page)
    {
        $this->setTemplateVariable('page', $page);
    }
}