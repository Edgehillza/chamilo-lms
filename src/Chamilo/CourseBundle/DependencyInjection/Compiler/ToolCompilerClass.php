<?php

namespace Chamilo\CourseBundle\DependencyInjection\Compiler;;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ToolCompilerClass
 * @package Chamilo\CourseBundle\DependencyInjection\Compiler
 */
class ToolCompilerClass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('chamilo.tool_chain')) {
            return;
        }

        $definition = $container->getDefinition(
            'chamilo.tool_chain'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'chamilo.course.tool'
        );

        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall('addTool', array(new Reference($id)));
        }
    }
}
