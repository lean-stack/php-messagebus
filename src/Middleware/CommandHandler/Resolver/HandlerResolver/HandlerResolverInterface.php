<?php

namespace Lean\MessageBus\Middleware\CommandHandler\Resolver\HandlerResolver;

interface HandlerResolverInterface
{
    /**
     * Returns the handler callable for a given command
     *
     * @param $command
     * @return callable
     */
    public function getHandlerForCommand($command);
}
