<?php

namespace App\src\Harvester;
use App\src\Interfaces\Harvest;

abstract class BaseHarvester implements Harvest
{
    private string $type;
    private int $capacity;
    private int $current_capacity;

    private string $uuid;


    public function __construct($type, $capacity, $uuid, $current_capacity)
    {
        $this->setType($type);
        $this->setCapacity($capacity);
        $this->setUuid($uuid);
        $this->setCurrentCapacity($current_capacity);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     */
    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return int
     */
    public function getCurrentCapacity(): int
    {
        return $this->current_capacity;
    }

    /**
     * @param int $current_capacity
     */
    public function setCurrentCapacity(int $current_capacity): void
    {
        $this->current_capacity = $current_capacity;
    }
}
