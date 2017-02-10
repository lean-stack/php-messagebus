<?php

namespace Lean\MessageBus;

use Lean\MessageBus\CommandBus\CommandBusInterface;
use Lean\MessageBus\CommandBus\CommandInterface;
use Lean\MessageBus\CommandBus\Middleware\MiddlewareInterface;

class CommandBus implements CommandBusInterface
{
    /**
     * @var MiddlewareInterface[]
     */
    protected $middlewares;

    /**
     * CommandBus constructor.
     *
     * @param MiddlewareInterface[] $middlewares
     */
    public function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;

        // Push a no-op middleware at the end
        $this->middlewares[] = new class implements MiddlewareInterface {
            function __invoke(CommandInterface $command, callable $next): void
            {
            }
        };
    }

    /**
     * Delegate a command to the command bus
     *
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command): void
    {
        $middlewareChain = $this->middlewares;

        /** @var MiddlewareInterface $next */
        while (($next = array_shift($middlewareChain)) !== null) {
            $next->__invoke($command, current($middlewareChain) ?: function(){});
        }
    }
}
