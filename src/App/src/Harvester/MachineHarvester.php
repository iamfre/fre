<?php

namespace App\src\Harvester;

use App\Helpers\DataBaseConnect;
use App\src\Garden;
use App\src\Models\Fruit;
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
     * @throws Exception
     */
    public function harvest(BaseTree $tree)
    {
        (new DataBaseConnect())->getConfigOrm();

        echo 'ДО' . '<br>';
        echo 'ВЕС ФУРЫ ' . $this->currentCapacity . '<br>';
        echo 'ФРУКТЫ В ФУРЕ ';
        print_r($this->fruits);
        echo '<br>';
        echo 'КОЛ-ВО НА ДЕРЕВЕ ' . $tree->fruitsQuantity . '<br>';
        echo '<br>' . 'ДЕРЕВО: ' . '<br>';
        var_export($tree);
        echo '<br>' . '<br>' . 'СБОРЩИК: ' . '<br>';
        var_export($this);

        while ($tree->fruitsQuantity) {
            $this->fruits[$tree->getType()]['weight'] += $tree->fruits[array_key_last($tree->fruits)];
            $this->currentCapacity += array_pop($tree->fruits);
            $tree->fruitsQuantity--;
            $this->fruits[$tree->getType()]['quantity'] += 1;

            if ($this->capacity < $this->currentCapacity + $tree->fruits[array_key_last($tree->fruits)]) {
                $this->unload();
            }
        }

        if ($this->currentCapacity !== 0) {
            $this->unload();
        }

        echo '<br>' . '<br>' . 'ПОСЛЕ' . '<br>';
        echo 'ВЕС ФУРЫ ' . $this->currentCapacity . '<br>';
        echo 'ФРУКТЫ В ФУРЕ ';
        print_r($this->fruits);
        echo '<br>';
        echo 'КОЛ-ВО НА ДЕРЕВЕ ' . $tree->fruitsQuantity . '<br>';
        echo '<br>' . 'ДЕРЕВО: ' . '<br>';
        var_export($tree);
        echo '<br>' . '<br>' . 'СБОРЩИК: ' . '<br>';
        var_export($this);
        die();
    }

    /**
     * Разгрузка сборщика фруктов
     *
     * @param bool $isLast
     * @return void
     */
    public function unload(bool $isLast = false): void
    {
        echo '<br>'. 'ПРЕВЫШЕНА ГРУЗОПОДЪЕМНОСТЬ - РАЗГРУЗКА' . '<br>';

        foreach ($this->fruits as $key => $value) {
            if ($value['quantity'] == 0) {
                continue;
            }
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
