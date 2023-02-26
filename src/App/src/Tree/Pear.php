<?php

namespace App\src\Tree;

use Ramsey\Uuid\Uuid;

class Pear extends BaseTree
{
    const FRUITS_MIN = 0;
    const FRUITS_MAX = 20;
    const TREE_TYPE = 'pear';

    public function __construct()
    {
        parent::__construct(self::TREE_TYPE, rand(self::FRUITS_MIN, self::FRUITS_MAX), Uuid::uuid4());
    }
}
