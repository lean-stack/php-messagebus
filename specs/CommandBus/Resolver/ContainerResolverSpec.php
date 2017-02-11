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
    function let(ContainerInterface $container, HandlerNameResolverInterface $handlerNameResolver)
    {
        $this->beConstructedWith($container, $handlerNameResolver);
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
        HandlerNameResolverInterface $handlerNameResolver,
        CommandInterface $command,
        CommandHandlerInterface $handler)
    {
        $commandName = 'do.something';

        $command->getName()->willReturn($commandName);
        $handlerNameResolver->getHandlerName($commandName)->willReturn($commandName . '_handler');
        $container->get($commandName. '_handler')->willReturn($handler);

        $this->getHandler($command)->shouldReturn($handler);
    }
}
