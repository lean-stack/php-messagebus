<?php

namespace Lean\MessageBus;

use Lean\MessageBus\CommandBus;
use Lean\MessageBus\MiddlewareInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandBusSpec extends ObjectBehavior
{
    public function let(MiddlewareInterface $middleware)
    {
        $this->beConstructedWith([$middleware]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommandBus::class);
    }

    public function it_can_handle_commands($command)
    {
        $this->handle($command)->shouldBe(null);
    }

    public function it_delegates_to_middleware($command, MiddlewareInterface $middleware)
    {
        $this->handle($command);

        $middleware->__invoke($command, Argument::type('callable'))->shouldHaveBeenCalled();
    }

    public function it_delegates_to_all_middlewares($command, MiddlewareInterface $mwA, MiddlewareInterface $mwB)
    {
        $this->beConstructedWith([$mwA, $mwB]);
        $this->handle($command);

        $mwA->__invoke($command, $mwB)->shouldHaveBeenCalled();
        $mwB->__invoke($command, Argument::type('callable'))->shouldHaveBeenCalled();
    }
}
