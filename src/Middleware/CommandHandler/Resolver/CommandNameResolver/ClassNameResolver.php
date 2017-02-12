<?php

namespace Lean\MessageBus\Middleware\CommandHandler\Resolver\CommandNameResolver;

class ClassNameResolver implements CommandNameResolverInterface
{
    /**
     * Returns a command name for a given command
     *
     * @param $command
     * @return string
     */
    public function getNameForCommand($command): string
    {
        return get_class($command);
    }
}
