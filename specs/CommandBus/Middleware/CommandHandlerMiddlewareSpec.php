<?php

namespace Lean\MessageBus\CommandBus\Middleware;

use Lean\MessageBus\CommandBus\CommandHandlerInterface;
use Lean\MessageBus\CommandBus\CommandInterface;
use Lean\MessageBus\CommandBus\Middleware\CommandHandlerMiddleware;
use Lean\MessageBus\CommandBus\Resolver\ResolverInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandHandlerMiddlewareSpec extends ObjectBehavior
{
    function let(ResolverInterface $resolver)
    {
        $this->beConstructedWith($resolver);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CommandHandlerMiddleware::class);
    }

    function it_is_middleware()
    {
        $this->shouldImplement(MiddlewareInterface::class);
    }

    function it_should_delegate_a_command(
        ResolverInterface $resolver,
        CommandInterface $command,
        CommandHandlerInterface $handler)
    {

        $resolver->getHandler($command)->willReturn($handler);
        $this->__invoke($command, function (){});
        $handler->handle($command)->shouldHaveBeenCalled();
    }
}
