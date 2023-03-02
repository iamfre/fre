<?php

namespace App\src\Tree;

use Ramsey\Uuid\Uuid;

class Pear extends BaseTree
{
    const FRUIT_QUANTITY = ['min' => 0, 'max' => 20];
    const FRUIT_WEIGHT = ['min' => 130, 'max' => 170];
    const TREE_TYPE = 'pear';

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
