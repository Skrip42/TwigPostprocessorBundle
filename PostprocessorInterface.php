<?php
namespace Skrip42\Bundle\TwigPostprocessorBundle;

interface PostprocessorInterface
{
    public function postProcess(
        string $content,
        string $name,
        array $context
    ) : string;
}
