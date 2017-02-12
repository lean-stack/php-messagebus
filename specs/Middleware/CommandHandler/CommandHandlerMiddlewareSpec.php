<?php

namespace Lean\MessageBus\Middleware\CommandHandler;

use Lean\MessageBus\Middleware\CommandHandler\CommandHandlerMiddleware;
use Lean\MessageBus\Middleware\CommandHandler\Resolver\HandlerResolver\HandlerResolverInterface;
use Lean\MessageBus\MiddlewareInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandHandlerMiddlewareSpec extends ObjectBehavior
{
    public function let(HandlerResolverInterface $resolver)
    {
        $this->beConstructedWith($resolver);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommandHandlerMiddleware::class);
    }

    public function it_is_a_middleware()
    {
        $this->shouldImplement(MiddlewareInterface::class);
    }

    public function it_delegates_a_command_to_a_closure_handler($command, HandlerResolverInterface $resolver)
    {
        $handler = function ($command) {
            trigger_error('Expected', E_USER_NOTICE);
        };

        $resolver->getHandlerForCommand($command)->willReturn($handler);
        $this->shouldTrigger(E_USER_NOTICE, 'Expected')->during('__invoke', [$command, function () {
        }]);
    }

    public function it_delegates_a_command_to_an_invocable($command, HandlerResolverInterface $resolver)
    {
        $handler = new class() {
            function __invoke($command)
            {
                trigger_error('Expected', E_USER_NOTICE);
            }
        };

        $resolver->getHandlerForCommand($command)->willReturn($handler);
        $this->shouldTrigger(E_USER_NOTICE, 'Expected')->during('__invoke', [$command, function () {
        }]);
    }

    public function it_delegates_a_command_to_an_instance_method($command, HandlerResolverInterface $resolver)
    {
        $handler = new class() {
            function handle($command)
            {
                trigger_error('Expected', E_USER_NOTICE);
            }
        };

        $resolver->getHandlerForCommand($command)->willReturn([$handler,'handle']);
        $this->shouldTrigger(E_USER_NOTICE, 'Expected')->during('__invoke', [$command, function () {
        }]);
    }
}
