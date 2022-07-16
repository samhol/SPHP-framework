<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\SyntaxHighlighting;

use Sphp\Html\Code\Pre;
use Sphp\Html\Code\Code;
use Sphp\Html\ContainerTag;
use Sphp\Stdlib\Filesystem;

/**
 * The Prism class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Prism implements SyntaxHighlighter {

  private bool $showLineNumbers = true;

  public function showLineNumbers(bool $showLineNumbers) {
    $this->showLineNumbers = $showLineNumbers;
    return $this;
  }

  public function blockFromFile(string $filename): string {
    $pre = new Pre();
    if (str_ends_with($filename, '.php')) {
      $source = Filesystem::toString($filename);
      $pre = $this->tagFromSource($source, 'php');
    } else {
      $pre->setAttribute('data-src', ltrim($filename, '.'));
    }
    if ($this->showLineNumbers) {
      $pre->addCssClass('line-numbers');
    }
    return (string) $pre;
  }

  private function parsePHP(string $source): string {
    return preg_replace(['/<(\?|\%)\=?(php)?/', '/(\%|\?)>/'], ['&lt;?php', '?&gt;'], $source);
  }

  private function tagFromSource(string $source, string $language): ContainerTag {
    $tag = new ContainerTag('script', $source);
    $tag->setAttribute('type', 'text/plain');
    if ($language === 'html' || $language === 'html5' || $language === 'svg') {
      $language = 'markup';
    }
    $tag->addCssClass("language-$language");
    return $tag;
  }

  public function blockFromString(string $source, string $language): string {
    return (string) $this->tagFromSource($source, $language);
  }

  public function inlineFromString(string $source, string $language): string {
    if ($language == 'php') {
      $source = $this->parsePHP($source);
    }
    $out = new Code($source);
    $out->addCssClass("language-$language");
    return (string) $out;
  }

}
