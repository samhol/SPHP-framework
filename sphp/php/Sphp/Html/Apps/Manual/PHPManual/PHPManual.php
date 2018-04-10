<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Manual\PHPManual;

use Sphp\Html\Apps\Manual\ClassLinkerInterface;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Apps\Manual\AbstractPhpApiLinker;

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
   * Constructs a new instance
   *
   * @param string|null $defaultTarget the default target used in the generated links or `null` for none
   * @param string|null $defaultCssClasses the default CSS classes used in the generated links or `null` for none
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function __construct(string $defaultTarget = null, $defaultCssClasses = ['api', 'phpman']) {
    parent::__construct(new PHPManualUrlGenerator(), $defaultTarget);
    $this->setDefaultCssClasses($defaultCssClasses);
  }

  public function hyperlink(string $url = null, string $content = null, string $title = null): Hyperlink {
    if ($title === null) {
      $title = 'PHP manual';
    } else {
      $title = 'PHP manual: ' . $title;
    }
    return parent::hyperlink($url, $content, $title);
  }

  public function classLinker(string $class): ClassLinkerInterface {
    return new PHPManualClassLinker($class, $this->urls(), $this->getDefaultTarget(), $this->getDefaultCssClasses());
  }

  public function constantLink(string $constant, string $linkText = null): Hyperlink {
    if ($linkText === null) {
      $linkText = $constant;
    }
    $path = $this->urls()->getConstantUrl($constant);
    return $this->hyperlink($path, $linkText, "$constant constant")
                    ->addCssClass('constant');
  }

  public function functionLink(string $funName, string $linkText = null): Hyperlink {
    if ($linkText === null) {
      $linkText = $funName;
    }
    $path = $this->urls()->getFunctionUrl($funName);
    return $this->hyperlink($path, $linkText, "$funName() function")->addCssClass('function');
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
    return $this->hyperlink($this->urls()->getRoot() . "book." . $path, $linkText, $extName);
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
    return $this->hyperlink($this->urls()->getRoot() . "language.types.$typename", $linkText, $title)
                    ->addCssClass('type');
  }

  /**
   * Returns a hyperlink object pointing to the PHP control structure in the PHP documentation
   *
   * @param  string $controlName the name of the PHP control structure (case insensitive)
   * @param  string $linkText the text of the link
   * @return Hyperlink hyperlink object pointing to the PHP control structure in the PHP
   *         documentation
   */
  public function controlStructLink(string $controlName): Hyperlink {
    $path = strtolower($controlName);
    return $this->hyperlink($this->urls()->getRoot() . "control-structures.$path", $controlName, $controlName);
  }

}
