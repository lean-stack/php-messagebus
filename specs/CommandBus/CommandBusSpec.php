<?php

namespace Lean\MessageBus\CommandBus;

use Lean\MessageBus\CommandBus\CommandInterface;
use Lean\MessageBus\CommandBus\Middleware\MiddlewareInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandBusSpec extends ObjectBehavior
{
    function it_should_invoke_middleware(CommandInterface $command, MiddlewareInterface $middleware)
    {
        $this->beConstructedWith([$middleware]);
        $this->handle($command);

        $middleware->__invoke($command, Argument::type('callable'))->shouldHaveBeenCalled();

    }

    function it_should_invoke_all_middlewares(CommandInterface $command, MiddlewareInterface $mwA, MiddlewareInterface $mwB)
    {
        $this->beConstructedWith([$mwA,$mwB]);
        $this->handle($command);

        $mwA->__invoke($command, $mwB)->shouldHaveBeenCalled();
        $mwB->__invoke($command, Argument::type('callable'))->shouldHaveBeenCalled();
    }
}
