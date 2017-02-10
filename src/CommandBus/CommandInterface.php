<?php

namespace Lean\MessageBus\CommandBus;

interface CommandInterface
{
    /**
     * Returns the command name
     *
     * @return string
     */
    public function getName() : string;
}