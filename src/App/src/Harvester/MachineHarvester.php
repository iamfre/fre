<?php

namespace App\src\Harvester;

use App\Helpers\DataBaseConnect;
use App\src\Garden;
use App\src\Models\Fruit;
use App\src\Models\Tree;
use App\src\Tree\BaseTree;
use Exception;
use Ramsey\Uuid\Uuid;

class MachineHarvester extends BaseHarvester
{
    public const CAPACITY = 5000;
    public const CURRENT_CAPACITY = 0;

    public const HARVESTER_TYPE = 'machine';

    public function __construct()
    {
        parent::__construct(
            self::HARVESTER_TYPE,
            self::CAPACITY,
            Uuid::uuid4(),
            self::CURRENT_CAPACITY
        );
    }

    /**
     * @param Tree $tree
     */
    public function harvest(Tree $tree)
    {
        (new DataBaseConnect())->getConfigOrm();

        echo '<br>' . 'ДО' . '<br>';
        echo 'ВЕС ФУРЫ ' . $this->currentCapacity . '<br>';
        echo 'ФРУКТЫ В ФУРЕ ';
        print_r($this->fruits);
        echo '<br>';
        echo 'КОЛ-ВО НА ДЕРЕВЕ ' . $tree->fruit_quantity . '<br>';
        echo '<br>' . 'ДЕРЕВО: ' . '<br>';
        var_export($tree);
        echo '<br>' . '<br>' . 'СБОРЩИК: ' . '<br>';
        var_export($this);

//        TODO: iamfree ПРИСВОИТЬ В МАССИВ ФРУКТЫ И ПОТОМ СЕЙВИТЬ ЧЕРЕЗ МОДЕЛЬ
        $fruits = json_decode($tree->fruits);

        for ($i = 0; $i < $tree->fruit_quantity; $i++) {

            if ($this->capacity < $this->currentCapacity + $fruits[array_key_last($fruits)]) {
                $this->unload();
            }
            $weight = array_pop($fruits);
            $this->fruits[$tree->type]['weight'] += $weight;
            $this->currentCapacity += $weight;

            $this->fruits[$tree->type]['quantity'] += 1;
        }

        if ($this->currentCapacity !== 0) {
            $this->unload();
        }
        foreach ($this->fruits as $key => $value) {
            $tree->fruit_quantity = $value['quantity'];
            $tree->fruits = json_encode($fruits);
            $tree->save();
        }

//        echo '<br>' . '<br>' . 'ПОСЛЕ' . '<br>';
//        echo 'ВЕС ФУРЫ ' . $this->currentCapacity . '<br>';
//        echo 'ФРУКТЫ В ФУРЕ ';
//        print_r($this->fruits);
//        echo '<br>';
//        echo 'КОЛ-ВО НА ДЕРЕВЕ ' . $tree->fruit_quantity . '<br>';
//        echo '<br>' . 'ДЕРЕВО: ' . '<br>';
//        var_export($tree);
//        echo '<br>' . '<br>' . 'СБОРЩИК: ' . '<br>';
//        var_export($this);
//        die();
    }

    /**
     * Разгрузка сборщика фруктов
     *
     * @param bool $isLast
     * @return void
     */
    public function unload(bool $isLast = false): void
    {
        foreach ($this->fruits as $key => $value) {
//            if ($value['quantity'] == 0) {
//                continue;
//            }
            $container = Fruit::whereType($key)->first();

            if (!isset($container)) {
                Fruit::create(
                    [
                        'type' => $key,
                        'quantity' => $value['quantity'],
                        'weight' => $value['weight'],
                    ]
                );
            } else {
                $container->quantity += $value['quantity'];
                $container->weight += $value['weight'];
                $container->save();
            }
            var_export($this->fruits);

            $this->fruits[$key]['weight'] -= $value['weight'];
            $this->fruits[$key]['quantity'] -= $value['quantity'];
            $this->currentCapacity -= $value['weight'];

//            TODO: ЛОГ что и сколько разгрузил
        }
    }
}
