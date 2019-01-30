<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators\PHPManual;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Apps\HyperlinkGenerators\AbstractPhpApiLinker;

/**
 * Hyperlink object generator pointing to PHP manual
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://php.net/manual/ PHP manual
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PHPManual extends AbstractPhpApiLinker {

  /**
   * Constructor
   *
   * @param PHPManualUrlGenerator $urlGenerator
   * @param string|null $namespace
   */
  public function __construct(PHPManualUrlGenerator $urlGenerator = null, string $namespace = null) {
    if ($urlGenerator === null) {
      $urlGenerator = new PHPManualUrlGenerator();
    }
    parent::__construct($urlGenerator, PHPManualClassLinker::class, $namespace);
  }

  public function hyperlink(string $url = null, string $content = null, string $title = null): Hyperlink {
    if ($title === null) {
      $title = 'PHP manual';
    } else {
      $title = 'PHP manual: ' . $title;
    }
    return parent::hyperlink($url, $content, $title);
  }

  /**
   * Returns a hyperlink object pointing to the PHP extension in the PHP documentation
   *
   * @param  string $extName the name of the PHP extension (case insensitive)
   * @param  string $linkText optional link text
   * @return Hyperlink hyperlink object pointing to the PHP documentation
   */
  public function extensionLink(string $extName, $linkText = null): Hyperlink {
    $path = strtolower($extName);
    if ($linkText === null) {
      $linkText = $extName;
    }
    return $this->hyperlink($this->urls()->getRoot() . "book." . $path, $linkText, $extName)->addCssClass('book');
  }

  /**
   * Returns a hyperlink object pointing to the PHP type documentation
   *
   * @param  mixed|string $type the PHP type or the name of the PHP type
   * @param  string $linkText optional link text
   * @return Hyperlink hyperlink object pointing to the PHP documentation
   */
  public function typeLink($type, string $linkText = null): Hyperlink {
    $typename = strtolower(gettype($type));
    if ($typename === 'string') {
      $typename = strtolower($type);
    }
    if ($typename === 'double') {
      $typename = 'float';
    }
    if ($linkText === null) {
      $linkText = $typename;
    }
    if ($typename === 'null') {
      $title = 'null type';
    } else {
      $title = "$typename type";
    }
    return $this->hyperlink($this->urls()->createUrl("language.types.$typename"), $linkText, $title)
                    ->addCssClass('type');
  }

  /**
   * Returns a hyperlink object pointing to the PHP control structure in the PHP documentation
   *
   * @param  string $controlName the name of the PHP control structure (case insensitive)
   * @return Hyperlink hyperlink object pointing to the PHP control structure in the PHP
   *         documentation
   */
  public function controlStructLink(string $controlName): Hyperlink {
    $path = strtolower($controlName);
    return $this->hyperlink($this->urls()->createUrl("control-structures.$path"), $controlName, $controlName);
  }

}
