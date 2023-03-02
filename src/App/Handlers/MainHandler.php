<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Helpers\DataBaseConnect;
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
        $treeFactory = new TreeFactory();
        (new DataBaseConnect())->getConfigOrm();

        $treeFactory->createOne(new Apple());

        $treeFactory->createSeveral([
            'apple' => 10,
            'pear' => 15,
        ]);

        return new JsonResponse(
            [
                'status' => 'ok'
            ]
        );
    }
}
