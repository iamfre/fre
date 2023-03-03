<?php

namespace App\src\Harvester;

use App\src\Models\Harvester;

class HarvesterFactory
{

    /**
     * Создать один экземпляр сборщика
     *
     * @param BaseHarvester $harvester
     * @return BaseHarvester
     */
    public function create(BaseHarvester $harvester): BaseHarvester
    {
        $harvester->setStatus(BaseHarvester::STATUS[1]);

        Harvester::create(
            [
                'type' => $harvester->getType(),
                'status' => $harvester->getStatus(),
                'capacity' => $harvester->getCapacity(),
                'uuid' => $harvester->getUuid(),
            ]
        );

        return $harvester;
    }

    public function getOne()
    {
        //
    }
}
