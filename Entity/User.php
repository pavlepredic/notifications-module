<?php

namespace Notifications\Entity;

use Notifications\Event\Event;
use Notifications\NotificationStrategy\NotificationStrategy;

/**
 * Represents a CMS user.
 * In a real-world system, Users would be created in CMS by superadmin
 */
class User extends Entity
{
    const ROLE_ADMIN = 'admin';
    const ROLE_MODERATOR = 'moderator';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $role;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var NotificationStrategy
     */
    protected $notificationStrategy;

    /**
     * @var Event[]
     * Array of Event this user is subscribed to
     */
    protected $events;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return NotificationStrategy
     */
    public function getNotificationStrategy()
    {
        return $this->notificationStrategy;
    }

    /**
     * @param NotificationStrategy $notificationStrategy
     */
    public function setNotificationStrategy($notificationStrategy)
    {
        $this->notificationStrategy = $notificationStrategy;
    }

    /**
     * @return Event[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    public function subscribeToEvent(Event $event)
    {
        $this->events[] = $event;
    }

    public function isSubscribedToEvent(Event $event)
    {
        foreach ($this->events as $userEvent)
        {
            if (get_class($userEvent) === get_class($event))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * We could change the string representation of User object
     * to be user name, and that would be reflected in notifications
     * @return string
     */
    public function __toString()
    {
        return $this->getRole();
        //another option of stringifying user
        //return $this->getName();
    }
}