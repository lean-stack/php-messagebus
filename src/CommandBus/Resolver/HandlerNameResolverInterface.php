<?php

namespace Lean\MessageBus\CommandBus\Resolver;

interface HandlerNameResolverInterface
{
    /**
     * Determines handler name base on command name
     *
     * @param string $commandName
     * @return mixed
     */
    public function getHandlerName(string $commandName);
}
