<?php

namespace Lean\MessageBus;

class CommandBus
{
    /**
     * @var MiddlewareInterface[]
     */
    protected $middlewares;

    public function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;

        // Push a no-op middleware at the end
        $this->middlewares[] = new class implements MiddlewareInterface {
            function __invoke($command, callable $next = null)
            {
            }
        };
    }

    /**
     * Handles a command
     *
     * @param object $command
     */
    public function handle($command)
    {
        $middlewareChain = $this->middlewares;

        /** @var MiddlewareInterface $next */
        while (($next = array_shift($middlewareChain)) !== null) {
            $next->__invoke($command, current($middlewareChain) ?: function () {
            });
        }
    }
}
