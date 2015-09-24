<?php

namespace Notifications\Entity\Template;

/**
 * Represents a template used for generating email contents.
 */
class MailTemplate extends Template
{
    /**
     * @var string
     */
    protected $subject;

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->injectVariables($this->subject);
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
}
