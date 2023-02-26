<?php

namespace App\src;

use App\Helpers\DataBaseConnect;
use App\src\Models\Tree;
use App\src\Tree\BaseTree;

class Garden
{
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
