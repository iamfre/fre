<?php

namespace App\src\Tree;

use App\src\Models\Tree;

class TreeFactory
{
    const AVAILABLE_TREE_TYPES = [
        0 => 'apple',
        1 => 'pear',
    ];

    /**
     * Создает один экземпляр дерева
     *
     * @param BaseTree $tree
     * @return void
     */
    public function createOne(BaseTree $tree): void
    {
        $fruits = [];

        $fruitWeight = $tree->getFruitWeight();

        for ($i = 0; $i < $tree->getFruitsQuantity(); $i++) {
            $fruits[] = rand($fruitWeight['min'], $fruitWeight['max']);
        }
        $tree->setFruits($fruits);

        $tree->setStatus(BaseTree::STATUSES[1]);

        Tree::create(
            [
                'type' => $tree->getType(),
                'fruit_quantity' => $tree->getFruitsQuantity(),
                'fruits' => json_encode($tree->getFruits()),
                'uuid' => $tree->getUuid(),
                'status' => $tree->getStatus(),
            ]
        );
    }

    /**
     * Создает заданное кол-во экземпляров указанных типов деревьев
     * param example ['apple' => 2, 'pear' => 3]
     *
     * @param array $data
     * @return void
     */
    public function createSeveral(array $data): void
    {
        foreach ($data as $key => $value) {

            switch ($key) {
                case self::AVAILABLE_TREE_TYPES[0]:
                    for ($i = 0; $i < $value; $i++) {
                        $this->createOne(new Apple());
                    }
                    break;
                case self::AVAILABLE_TREE_TYPES[1]:
                    for ($i = 0; $i < $value; $i++) {
                        $this->createOne(new Pear());
                    }
                    break;
            }
        }
    }
}
