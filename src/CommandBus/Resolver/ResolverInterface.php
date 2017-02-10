<?php

namespace Lean\MessageBus\CommandBus\Resolver;

use Lean\MessageBus\CommandBus\CommandHandlerInterface;
use Lean\MessageBus\CommandBus\CommandInterface;

interface ResolverInterface
{
    /**
     * Resolves a handler for a given command
     *
     * @param CommandInterface $command
     * @return CommandHandlerInterface
     */
    public function getHandler(CommandInterface $command) : CommandHandlerInterface;
}