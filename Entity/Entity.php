<?php

namespace Notifications\Entity;

/**
 * Represents an object that can be persisted to storage
 * For the purposes of this exercise, all entities
 * are stored in memory
 */
class Entity
{
    /**
     * @var Entity[]
     */
    static $entities = [];

    public function __construct()
    {
        self::$entities[get_class($this)][] = $this;
    }

    public static function findAll()
    {
        if (isset(self::$entities[static::class]))
        {
            return self::$entities[static::class];
        }
        return [];
    }
}