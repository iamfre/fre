<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Helpers\DataBaseConnect;
use App\src\Harvester\HarvesterFactory;
use App\src\Harvester\MachineHarvester;
use App\src\Tree\Apple;
use App\src\Tree\TreeFactory;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MainHandler implements RequestHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     * @throws Exception
     */
    public function handle(ServerRequestInterface $request): JsonResponse
    {
        (new DataBaseConnect())->getConfigOrm();

        // farm
        $treeFactory = new TreeFactory();
//        $exampleOneTree = $treeFactory->createOne(new Apple());
        $exampleSeveralTrees = $treeFactory->createSeveral([
            'apple' => 10,
            'pear' => 15,
        ]);
//        echo '<pre>';
//        var_dump($exampleOneTree);
//        die();
        // harvest

        $harvesterFactory = new HarvesterFactory();
        $harvester = $harvesterFactory->create(new MachineHarvester());

        // сбор
        foreach ($exampleSeveralTrees as $value) {
            $harvester->harvest($value);
        }

        die();
        return new JsonResponse(
            [
                'сборщик' => $harvester,
                'одно дерево' => $exampleOneTree,
//                'несколько деревьев' => $exampleSeveralTrees,
            ]
        );
    }
}
