<?php
namespace Skrip42\Bundle\TwigPostprocessorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Skrip42\Bundle\TwigPostprocessorBundle\Factory;

class TwigPostprocessorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $twig = $container->getDefinition('twig');
        $postprocessors = $container->findTaggedServiceIds('twig.postprocessor');
        $postprocessorArray = [];
        foreach (array_keys($postprocessors) as $name) {
            $postprocessorArray[] = new Reference($name);
        }
        $twig->setFactory([new Reference(Factory::class), 'create']);
        $twig->setArguments([
            $twig->getClass(),
            $twig->getArguments(),
            $postprocessorArray
        ]);
    }
}
