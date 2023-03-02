<?php

namespace App\src\Tree;

abstract class BaseTree
{
    const STATUSES = [
        0 => 'growing',
        1 => 'ripe',
        2 => 'harvesting',
    ];
    private string $type;
    private string $quantity_fruits;
    private string $uuid;
    private string $status;

    public function __construct($type, $quantity_fruits, $uuid, $status = self::STATUSES[0])
    {
        $this->setType($type);
        $this->setQuantityFruits($quantity_fruits);
        $this->setUuid($uuid);
        $this->setStatus($status);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getQuantityFruits(): int
    {
        return $this->quantity_fruits;
    }

    /**
     * @param int $quantity_fruits
     */
    public function setQuantityFruits(int $quantity_fruits): void
    {
        $this->quantity_fruits = $quantity_fruits;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
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
}
