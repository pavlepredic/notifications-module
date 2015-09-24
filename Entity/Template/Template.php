<?php

namespace Notifications\Entity\Template;

use Notifications\Entity\Entity;
use Notifications\Event\Event;

/**
 * Base class for all types of templates
 */
abstract class Template extends Entity
{
    /**
     * Let's assume we agreed upon a convention of using percent sign to
     * enclose variables in templates, eg: Dear %user%, ...
     */
    const VARIABLE_ENCLOSURE = '%';

    /**
     * @var array
     */
    protected $variables;

    /**
     * @var Event
     */
    protected $event;

    /**
     * @var string
     */
    protected $text;

    public function setVariable($name, $value)
    {
        $this->variables[self::VARIABLE_ENCLOSURE . $name . self::VARIABLE_ENCLOSURE] = $value;
    }

    public function setVariables(array $variables)
    {
        foreach ($variables as $name => $value)
        {
            $this->setVariable($name, $value);
        }
    }

    protected function injectVariables($string)
    {
        return strtr($string, $this->variables);
    }

    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param Event $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->injectVariables($this->text);
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
}