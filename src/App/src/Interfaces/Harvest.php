<?php

namespace App\src\Interfaces;

use App\src\Tree\BaseTree;

interface Harvest
{
    public function harvest(BaseTree $tree);
}