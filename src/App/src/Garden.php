<?php

namespace App\src;

use App\Helpers\DataBaseConnect;
use App\src\Models\Tree;
use App\src\Tree\BaseTree;

class Garden
{
    const APPLE_FRUIT_WEIGHT = ['min' => 150, 'max' =>180];
    const PEAR_FRUIT_WEIGHT = ['min' => 130, 'max' =>170];
    public function makeTree(BaseTree $tree)
    {
        (new DataBaseConnect())->getConfigOrm();

        return Tree::create(
            [
                'type' => $tree->getType(),
                'quantity_fruits' => $tree->getQuantityFruits(),
                'uuid' => $tree->getUuid(),
            ]
        );
    }
}
