<?php

/**
 * AbstractPhpApiLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * Link generator pointing to an existing API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractPhpApiLinker extends AbstractLinker {

  public function hyperlink($url = null, $content = null, $title = null) {
    if ($content === null) {
      $content = $url;
    }
    return parent::hyperlink($url, str_replace('\\', '\\<wbr>', $content), $title);
  }

  /**
   * Return the class property linker
   *
   * @param  string|\object $class class name or object
   * @return PhpClassLinkerInterface the class property linker
   */
  abstract public function classLinker($class);

  /**
   * Returns a hyperlink object pointing to an API page describing PHP function 
   *
   * @param  string $funName the name of the function
   * @return string hyperlink object pointing to an PHP function page
   */
  abstract public function functionLink($funName);

  /**
   * Returns a hyperlink object pointing to PHP's predefined constants page
   * 
   * @param  string $constantName the name of the constant
   * @return string hyperlink object pointing to PHP's predefined constants page
   */
  abstract public function constantLink($constantName);
}
