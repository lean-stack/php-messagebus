<?php

namespace Lean\MessageBus\Middleware\CommandHandler\Resolver;

interface HandlerResolverInterface
{
    public function getHandlerForCommand($argument1);
}
