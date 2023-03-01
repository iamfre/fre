<?php

namespace App\src\Harvester;

use App\Helpers\DataBaseConnect;
use App\src\Garden;
use App\src\Models\Fruit;
use App\src\Models\Tree;
use App\src\Tree\Apple;
use App\src\Tree\Pear;
use Exception;
use Ramsey\Uuid\Uuid;

class MachineHarvester extends BaseHarvester
{
    const CAPACITY = 15000;
    const CURRENT_CAPACITY = 0;

    const HARVESTER_TYPE = 'machine';

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
            echo "Старт сбора с $tree->type всего $tree->quantity_fruits" . '<br>';
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
                    echo "Предел веса $totalCurrentWeight" . '<br>';

                    foreach ($fruits as $key => $value) {

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

                        echo "Отгружено $key в кол-ве " . $value['quantity'] . " общим весом " . $value['weight'] . '<br>';
                        $fruits[$key]['weight'] -= $value['weight'];
                        $fruits[$key]['quantity'] -= $value['quantity'];
                        $totalCurrentWeight -= $value['weight'];
                    }
                }

                $totalCurrentWeight += $fruits_weight;
                $fruits[$tree->type]['weight'] += $fruits_weight;
                $fruits[$tree->type]['quantity']++;
                if ($tree->quantity_fruits == $i + 1) {
                    echo "С дерева $tree->type собраны все фрукты " . ($i + 1) . '<br>';
                    $tree->quantity_fruits -= ($i + 1);
                    $tree->save();
                    echo "На дереве $tree->type осталось $tree->quantity_fruits фруктов" . '<br>';
                }
            }

        }

        echo "Последняя разгрузка $totalCurrentWeight" . '<br>';

        foreach ($fruits as $key => $value) {

            $sklad = Fruit::whereType($key)->first();

            if (!isset($sklad)) {
                Fruit::create(
                    [
                        'type' => $key,
                        'quantity' => $value['quantity'],
                        'weight' => $value['weight'],
                    ]
                );
            } else {
                $sklad->quantity += $value['quantity'];
                $sklad->weight += $value['weight'];
                $sklad->save();
            }

            echo "Отгружено $key в кол-ве " . $value['quantity'] . " общим весом " . $value['weight'] . '<br>';
            $fruits[$key]['weight'] -= $value['weight'];
            $fruits[$key]['quantity'] -= $value['quantity'];
            $totalCurrentWeight -= $value['weight'];
        }
//        TODO: iamfree
        var_export($fruits);
        die();
    }
}
