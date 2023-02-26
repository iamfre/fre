<?php

namespace App\src\Tree;
use Ramsey\Uuid\Uuid;

class Apple extends BaseTree
{
    const FRUITS_MIN = 40;
    const FRUITS_MAX = 50;
    const TREE_TYPE = 'apple';

    public function __construct()
    {
        parent::__construct(self::TREE_TYPE, rand(self::FRUITS_MIN, self::FRUITS_MAX), Uuid::uuid4());
    }
}
