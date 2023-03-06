<?php

namespace App\src\Interfaces;

use App\src\Models\Tree;

interface Harvest
{
    public function harvest(Tree $tree);
}