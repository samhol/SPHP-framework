<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Apps\Manual\ClassLinkerInterface;

/**
 * Hyperlink generator pointing to an online PHP API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractPhpApiLinker extends AbstractLinker {

  public function hyperlink(string $url = null, string $content = null, string $title = null): Hyperlink {
    if ($content === null) {
      $content = $url;
    }
    return parent::hyperlink($url, str_replace('\\', '\\<wbr>', $content), $title);
  }

  /**
   * Return the class property linker for the given class
   *
   * @param  string $class class name or object
   * @return ClassLinkerInterface the class property linker
   */
  abstract public function classLinker(string $class): ClassLinkerInterface;

  /**
   * Returns a hyperlink object pointing to an API page describing PHP function 
   *
   * @param  string $funName the name of the function
   * @param  string $linkText optional link text
   * @return Hyperlink hyperlink object pointing to the documentation
   */
  abstract public function functionLink(string $funName, string $linkText = null): Hyperlink;

  /**
   * Returns a hyperlink object pointing to an API page describing PHP constant 
   * 
   * @param  string $constantName the name of the constant
   * @param  string $linkText optional link text
   * @return Hyperlink hyperlink object pointing to the documentation
   */
  abstract public function constantLink(string $constantName, string $linkText = null): Hyperlink;
}
