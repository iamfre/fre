<?php

declare(strict_types=1);

namespace App\Factories;

use App\Handlers\MainHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MainHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        return new MainHandler();
    }
}
