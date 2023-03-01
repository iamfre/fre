<?php

declare(strict_types=1);

namespace App\Handlers;

use App\src\Garden;
use App\src\Harvester\MachineHarvester;
use App\src\Tree\Apple;
use App\src\Tree\Pear;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MainHandler implements RequestHandlerInterface
{
    private const APPLE_QUANTITY = 2;
    private const PEAR_QUANTITY = 2;

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     * @throws Exception
     */
    public function handle(ServerRequestInterface $request): JsonResponse
    {
        $garden = new Garden();
        $trees = [];

        for ($i = 0; $i < self::APPLE_QUANTITY; $i++) {
            $trees[] = $garden->makeTree(new Apple());
        }

        for ($i = 0; $i < self::PEAR_QUANTITY; $i++) {
            $trees[] = $garden->makeTree(new Pear());
        }

        $wasCreated = json_encode($trees);

        $harvester = new MachineHarvester();
        $harvester->harvest($trees);

        return new JsonResponse(json_decode($wasCreated));
    }
}
