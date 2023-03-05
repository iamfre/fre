<?php

namespace App\src\Harvester;

use App\src\Interfaces\Harvest;

abstract class BaseHarvester implements Harvest
{
    public const FRUITS = [];

    public const STATUS = [
        0 => 'busy',
        1 => 'free',
    ];

    public string $type;
    public int $capacity;
    public int $currentCapacity;
    public string $uuid;
    public string $status;
    public array $fruits;

    public function __construct($type, $capacity, $uuid, $currentCapacity, $status = self::STATUS[1],
                                $fruits = self::FRUITS)
    {
        $this->setType($type);
        $this->setCapacity($capacity);
        $this->setUuid($uuid);
        $this->setCurrentCapacity($currentCapacity);
        $this->setStatus($status);
        $this->setFruits($fruits);
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
        return $this->currentCapacity;
    }

    /**
     * @param int $currentCapacity
     */
    public function setCurrentCapacity(int $currentCapacity): void
    {
        $this->currentCapacity = $currentCapacity;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getFruits(): array
    {
        return $this->fruits;
    }

    /**
     * @param array $fruits
     */
    public function setFruits(array $fruits): void
    {
        $this->fruits = $fruits;
    }
}
