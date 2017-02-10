<?php

namespace Lean\MessageBus\CommandBus\Middleware;

use Lean\MessageBus\CommandBus\CommandInterface;

interface MiddlewareInterface
{
    /**
     * Handles the delegation of a command
     *
     * @param CommandInterface $command
     * @param callable $next
     */
    function __invoke(CommandInterface $command, callable $next);
}
