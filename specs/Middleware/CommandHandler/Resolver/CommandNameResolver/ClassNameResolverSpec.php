<?php

namespace Lean\MessageBus\Middleware\CommandHandler\Resolver\CommandNameResolver;

use Lean\MessageBus\Middleware\CommandHandler\Resolver\CommandNameResolver\ClassNameResolver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassNameResolverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ClassNameResolver::class);
    }

    function it_is_a_command_name_resolver()
    {
        $this->shouldImplement(CommandNameResolverInterface::class);
    }

    function it_resolves_a_class_name_for_given_command($command)
    {
        $expectedName = ClassNameResolver::class;
        $this->getNameForCommand($this->getWrappedObject())->shouldBe($expectedName);
    }
}
