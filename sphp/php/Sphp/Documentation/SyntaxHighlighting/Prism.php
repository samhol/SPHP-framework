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

use Sphp\Stdlib\Strings;
use Sphp\Html\Sections\Pre;
use Sphp\Html\Sections\Code;

/**
 * The Prism class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Prism implements SyntaxHighlighter {

  public function blockFromFile(string $filename): string {
    $pre = new Pre();
    if (Strings::endsWith($filename, '.php')) {
      $file = new \SplFileObject($filename);
      $source = \Sphp\Stdlib\Filesystem::toString($filename);
      $pre->appendCode($this->parsePHP($source))->addCssClass('language-php');
    } else {
      $file = new \SplFileInfo($filename);
      $pre->setAttribute('data-src', $filename);
    }
    return (string) $pre;
  }

  private function parsePHP(string $source): string {
    return preg_replace(['/<(\?|\%)\=?(php)?/', '/(\%|\?)>/'], ['&lt;?php', '?&gt;'], $source);
  }

  public function blockFromString(string $source, string $language): string {
    if ($language === 'html') {
      $language = 'markup';
    }
    $tag = new Pre();
    if ($language == 'php') {
      $tag->appendCode($this->parsePHP($source))->addCssClass('language-php');
    } else if ($language == 'markup') {
      $tag = new \Sphp\Html\ContainerTag('script', $source);
      $tag->setAttribute('type', 'text/plain');
      $tag->addCssClass("language-markup");
     //echo 'markup';
      // $pre->appendCode(htmlentities($source))
    } else {
      $tag->appendCode($source)->addCssClass("language-$language");
    }
    return (string) $tag;
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
