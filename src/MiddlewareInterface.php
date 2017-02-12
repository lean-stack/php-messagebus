<?php

namespace Lean\MessageBus;

interface MiddlewareInterface
{
    /**
     * Handles the delegation of a message
     *
     * @param object $message
     * @param callable $next
     *
     * @return mixed
     */
    public function __invoke($command, callable $next = null);
}
