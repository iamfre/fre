<?php

declare(strict_types=1);

namespace App\Handlers;

use App\src\Garden;
use App\src\Tree\Apple;
use App\src\Tree\Pear;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MainHandler implements RequestHandlerInterface
{
    private const APPLE_QUANTITY = 10;
    private const PEAR_QUANTITY = 15;

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
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

        return new JsonResponse($trees);
    }
}
