<?php

namespace Lean\MessageBus\CommandBus\Resolver;

use Lean\MessageBus\CommandBus\CommandHandlerInterface;
use Lean\MessageBus\CommandBus\CommandInterface;
use Psr\Container\ContainerInterface;

class ContainerResolver implements ResolverInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ContainerResolver constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Resolves a handler for a given command
     *
     * @param CommandInterface $command
     * @return CommandHandlerInterface
     */
    public function getHandler(CommandInterface $command): CommandHandlerInterface
    {
        if( ((string)$command->getName()) === '') {
            throw new \InvalidArgumentException('Command has no name.');
        }

        return $this->container->get($command->getName());
    }
}
