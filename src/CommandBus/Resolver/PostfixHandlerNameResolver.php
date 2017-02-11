<?php

namespace Lean\MessageBus\CommandBus\Resolver;

class PostfixHandlerNameResolver implements HandlerNameResolverInterface
{
    /**
     * Determines handler name base on command name
     *
     * @param string $commandName
     * @return mixed
     */
    public function getHandlerName(string $commandName)
    {
        return $commandName . '_handler';
    }
}
