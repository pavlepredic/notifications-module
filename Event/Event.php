<?php

namespace Notifications\Event;

use Notifications\Entity\Template\Template;

/**
 * Base class for all types of events
 */
abstract class Event
{
    /**
     * @var array
     */
    protected $templateVariables = [];

    public function getTemplateByType(Template $type)
    {
        /* @var $template Template */
        foreach ($type->findAll() as $template)
        {
            if (get_class($template->getEvent()) === get_class($this) and get_class($template) === get_class($type))
            {
                return $template;
            }
        }

        throw new \Exception("Please provide a template of type '" . get_class($type) . "' for Event '" . get_class($this) . "'");
    }

    /**
     * @return array
     */
    public function getTemplateVariables()
    {
        return $this->templateVariables;
    }

    public function setTemplateVariable($name, $value)
    {
        $this->templateVariables[$name] = $value;
    }
}