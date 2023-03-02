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
    private array $fruits;
    private int $fruitsQuantity;
    private string $uuid;
    private string $status;

    private array $fruitWeight;

    public function __construct($type, $fruitsQuantity, $uuid, $fruitWeight, $status = self::STATUSES[0])
    {
        $this->setType($type);
        $this->setFruitsQuantity($fruitsQuantity);
        $this->setUuid($uuid);
        $this->setFruitWeight($fruitWeight);
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

    /**
     * @return int
     */
    public function getFruitsQuantity(): int
    {
        return $this->fruitsQuantity;
    }

    /**
     * @param int $fruitsQuantity
     */
    public function setFruitsQuantity(int $fruitsQuantity): void
    {
        $this->fruitsQuantity = $fruitsQuantity;
    }

    /**
     * @return array
     */
    public function getFruitWeight(): array
    {
        return $this->fruitWeight;
    }

    /**
     * @param array $fruitWeight
     */
    public function setFruitWeight(array $fruitWeight): void
    {
        $this->fruitWeight = $fruitWeight;
    }
}
