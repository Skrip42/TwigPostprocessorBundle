<?php
namespace Skrip42\Bundle\TwigPostprocessorBundle;

use Skrip42\Bundle\TwigPostprocessorBundle\DependencyInjection\TwigPostprocessorCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;

class TwigPostprocessorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(
            new TwigPostprocessorCompilerPass(),
            PassConfig::TYPE_BEFORE_REMOVING
        );
    }
}
