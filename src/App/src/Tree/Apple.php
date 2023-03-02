<?php

namespace App\src\Tree;

use Ramsey\Uuid\Uuid;

class Apple extends BaseTree
{
    const LIMIT_QUANTITY = ['min' => 40, 'max' => 50];

    const TREE_TYPE = 'apple';

    public function __construct()
    {
        parent::__construct(
            self::TREE_TYPE,
            rand(self::LIMIT_QUANTITY['min'], self::LIMIT_QUANTITY['max']),
            Uuid::uuid4()
        );
    }
}
