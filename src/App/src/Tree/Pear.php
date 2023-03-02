<?php

namespace App\src\Tree;

use Ramsey\Uuid\Uuid;

class Pear extends BaseTree
{
    const LIMIT_QUANTITY = ['min' => 0, 'max' => 20];
    const TREE_TYPE = 'pear';

    public function __construct()
    {
        parent::__construct(
            self::TREE_TYPE,
            rand(self::LIMIT_QUANTITY['min'], self::LIMIT_QUANTITY['max']),
            Uuid::uuid4()
        );
    }
}
