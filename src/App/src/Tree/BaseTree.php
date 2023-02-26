<?php

namespace App\src\Tree;

abstract class BaseTree
{
    private string $type;
    private int $quantity_fruits;
    private string $uuid;

    public function __construct($type, $quantity_fruits, $uuid)
    {
        $this->setType($type);
        $this->setQuantityFruits($quantity_fruits);
        $this->setUuid($uuid);
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
}
