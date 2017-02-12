<?php

namespace Lean\MessageBus\Middleware\CommandHandler\Resolver\HandlerResolver;

use Lean\MessageBus\Middleware\CommandHandler\Resolver\CommandNameResolver\CommandNameResolverInterface;

class MapResolver implements HandlerResolverInterface
{
    /**
     * @var CommandNameResolverInterface
     */
    private $commandNameResolver;

    /**
     * @var array
     */
    private $commandNameToHandlerMap;

    /**
     * MapResolver constructor.
     *
     * @param array $commandNameToHandlerMap
     */
    public function __construct(CommandNameResolverInterface $resolver, array $commandNameToHandlerMap)
    {
        $this->commandNameResolver = $resolver;
        $this->commandNameToHandlerMap = $commandNameToHandlerMap;
    }

    /**
     * Returns the handler callable for a given command
     *
     * @param $command
     * @return callable
     */
    public function getHandlerForCommand($command)
    {
        $commandName = $this->commandNameResolver->getNameForCommand($command);
        return $this->commandNameToHandlerMap[$commandName];
    }
}
