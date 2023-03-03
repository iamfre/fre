<?php

namespace App\src\Harvester;

use App\Helpers\DataBaseConnect;
use App\src\Garden;
use App\src\Models\Fruit;
use Exception;
use Ramsey\Uuid\Uuid;

class MachineHarvester extends BaseHarvester
{
    public const CAPACITY = 15000;
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
    public function harvest($data)
    {
        (new DataBaseConnect())->getConfigOrm();

        $fruits = [];
        $totalCurrentWeight = 0;

        foreach ($data as $tree) {
            for ($i = 0; $i < $tree->quantity_fruits; $i++) {
                switch ($tree->type) {
                    case 'apple':
                        $fruits_weight = rand(
                            Garden::APPLE_FRUIT_WEIGHT['min'],
                            Garden::APPLE_FRUIT_WEIGHT['max']
                        );
                        break;
                    case 'pear':
                        $fruits_weight = rand(
                            Garden::PEAR_FRUIT_WEIGHT['min'],
                            Garden::PEAR_FRUIT_WEIGHT['max']
                        );
                        break;
                    default:
                        throw new Exception('Тип дерева не поддерживается');
                }

                if (($totalCurrentWeight + $fruits_weight > self::CAPACITY - $this->getCurrentCapacity())) {
                    $fruits = $this->unload($fruits,$totalCurrentWeight);
                }

                $totalCurrentWeight += $fruits_weight;
                $fruits[$tree->type]['weight'] += $fruits_weight;
                $fruits[$tree->type]['quantity']++;
                if ($tree->quantity_fruits == $i + 1) {
                    $tree->quantity_fruits -= ($i + 1);
                    $tree->save();
                }
            }

        }

        $this->unload($fruits, $totalCurrentWeight, true);
    }


    /**
     * @param $fruits
     * @param $totalCurrentWeight
     * @param bool $isLast
     * @return array|void
     */
    public function unload($fruits, &$totalCurrentWeight, bool $isLast = false)
    {
        foreach ($fruits as $key => $value) {
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

            $fruits[$key]['weight'] -= $value['weight'];
            $fruits[$key]['quantity'] -= $value['quantity'];
            $totalCurrentWeight -= $value['weight'];
        }
        return $fruits;
    }
}
