<?php

namespace Notifications\Event;

/**
 * Represents an event that is triggered when a new article is published.
 */
class NewArticleEvent extends Event
{
    public function setCategory($category)
    {
        $this->setTemplateVariable('category', $category);
    }
}