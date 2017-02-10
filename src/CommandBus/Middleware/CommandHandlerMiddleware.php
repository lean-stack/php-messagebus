<?php

namespace Lean\MessageBus\CommandBus\Middleware;

use Lean\MessageBus\CommandBus\CommandInterface;
use Lean\MessageBus\CommandBus\Resolver\ResolverInterface;

class CommandHandlerMiddleware implements MiddlewareInterface
{
    /**
     * @var ResolverInterface
     */
    private $resolver;

    /**
     * CommandHandlerMiddleware constructor.
     * @param ResolverInterface $resolver
     */
    public function __construct(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Handles the delegation of a command
     *
     * @param CommandInterface $command
     * @param callable $next
     */
    function __invoke(CommandInterface $command, callable $next): void
    {
        $handler = $this->resolver->getHandler($command);
        $handler->handle($command);

        $next($command);
    }
}