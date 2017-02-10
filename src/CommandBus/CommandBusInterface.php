<?php

namespace Lean\MessageBus\CommandBus;

interface CommandBusInterface
{
    /**
     * Delegate a command to the command bus
     *
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command) : void;
}
