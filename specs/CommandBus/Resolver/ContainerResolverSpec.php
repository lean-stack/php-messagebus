<?php

namespace Lean\MessageBus\CommandBus\Resolver;

use Lean\MessageBus\CommandBus\CommandHandlerInterface;
use Lean\MessageBus\CommandBus\CommandInterface;
use Lean\MessageBus\CommandBus\Resolver\ContainerResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Container\ContainerInterface;

class ContainerResolverSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ContainerResolver::class);
    }

    function it_is_a_handler_resolver()
    {
        $this->shouldImplement(ResolverInterface::class);
    }

    function it_can_resolve_a_handler_by_command_name(
        ContainerInterface $container,
        CommandInterface $command,
        CommandHandlerInterface $handler)
    {
        $commandName = $command->getName()->willReturn('do.something');
        $container->get('do.something')->willReturn($handler);

        $this->getHandler($command)->shouldReturn($handler);
    }
}
