<?php

namespace App\src\Tree;

use Ramsey\Uuid\Uuid;

class Apple extends BaseTree
{
    public const FRUIT_QUANTITY = ['min' => 40, 'max' => 50];
    public const FRUIT_WEIGHT = ['min' => 150, 'max' => 180];

    public const TREE_TYPE = 'apple';

    public function __construct()
    {
        parent::__construct(
            self::TREE_TYPE,
            rand(self::FRUIT_QUANTITY['min'], self::FRUIT_QUANTITY['max']),
            Uuid::uuid4(),
            self::FRUIT_WEIGHT,
        );
    }
}
