<?php

namespace Lean\MessageBus\Middleware\CommandHandler;

use Lean\MessageBus\Middleware\CommandHandler\Resolver\HandlerResolver\HandlerResolverInterface;
use Lean\MessageBus\MiddlewareInterface;

class CommandHandlerMiddleware implements MiddlewareInterface
{
    /**
     * @var HandlerResolverInterface
     */
    private $handlerResolver;

    public function __construct($handlerResolver)
    {
        $this->handlerResolver = $handlerResolver;
    }

    /**
     * Handles the delegation of a command
     *
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function __invoke($command, callable $next = null)
    {
        $handler = $this->handlerResolver->getHandlerForCommand($command);
        $handler($command);

        if ($next !== null) {
            $next($command);
        };
    }
}
