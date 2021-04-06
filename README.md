# TwigPostprocessorBundle
symphony bundle that adds post-processing functionality to your twig

## install
```shell
composer require Skrip42/twig-postprocessor-bundle
```

## usabe
- create you own postprocessor that implements Skrip42\Bundle\TwigPostprocessorBundle\PostprocessorInterface
```php
namespace App\Twig;

use Skrip42\Bundle\TwigPostprocessorBundle\PostprocessorInterface;

class YouOwnProcessor implements PostprocessorInterface
{
  /**
   * @params string $content - raw html string
   * @params string $name - template name
   * @params array $context - array of template params
   *
   * @return string - modifyed html string
   */
  public function postProcess(
    string $content,
    string $name,
    array $context
  ): string {
    return someChange($content);
  }
}
```
- define you processo as twig postprocessor
```yaml
  App\Twig\YouOwnProcessor:
    tags:[twig.postprocessor]
```
