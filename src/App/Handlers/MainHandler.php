<?php

declare(strict_types=1);

namespace App\Handlers;

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MainHandler implements RequestHandlerInterface
{

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     */
    public function handle(ServerRequestInterface $request): JsonResponse
    {

        return new JsonResponse([
            'status' => 'ok'
        ]);
    }
}
