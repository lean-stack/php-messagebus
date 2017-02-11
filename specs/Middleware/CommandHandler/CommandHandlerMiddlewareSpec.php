<?php

namespace Lean\MessageBus\Middleware\CommandHandler;

use Lean\MessageBus\Middleware\CommandHandler\CommandHandlerMiddleware;
use Lean\MessageBus\Middleware\CommandHandler\Resolver\HandlerResolverInterface;
use Lean\MessageBus\MiddlewareInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandHandlerMiddlewareSpec extends ObjectBehavior
{
    function let(HandlerResolverInterface $resolver)
    {
        $this->beConstructedWith($resolver);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CommandHandlerMiddleware::class);
    }

    function it_is_a_middleware()
    {
        $this->shouldImplement(MiddlewareInterface::class);
    }

    function it_delegates_a_command_to_its_handler($command, HandlerResolverInterface $resolver, MiddlewareInterface $handler)
    {
        $resolver->getHandlerForCommand($command)->willReturn($handler);
        $this->__invoke($command, function (){});

        $handler->__invoke($command)->shouldHaveBeenCalled();
    }
}
