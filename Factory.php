<?php
namespace Skrip42\Bundle\TwigPostprocessorBundle;

use ProxyManager\Factory\AccessInterceptorValueHolderFactory;

class Factory
{
    private $postprocessors;

    public function __construct()
    {
        $this->factory = new AccessInterceptorValueHolderFactory();
    }

    /**
     * @var PostprocessorInterface[] $postprocessors
     */
    public function create(
        string $className,
        array $arguments,
        array $postprocessors
    ) {
        $instance = new $className(...$arguments);
        $proxy = $this->factory->createProxy(
            $instance,
            [],
            $this->createPostCallArray()
        );
        $this->postprocessors = $postprocessors;
        return $proxy;
    }

    private function createPostCallArray(): array
    {
        //executed after twig->render() method
        return ['render' => function (
            $proxy,
            $instance,
            $method,
            $params,
            $return,
            &$returnEarly
        ) {
            foreach ($this->postprocessors as $postprocessor) {
                $return = $postprocessor->postProcess(
                    $return,
                    $params['name'],
                    $params['context']
                );
            }
            $returnEarly = true;
            return $return;
        }];
    }
}
