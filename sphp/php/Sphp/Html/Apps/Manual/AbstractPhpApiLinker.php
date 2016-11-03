<?php

/**
 * AbstractPhpApiLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * Hyperlink generator pointing to an online PHP API documentation
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
   * Return the class property linker for the given class
   *
   * @param  string|\object $class class name or object
   * @return ClassLinkerInterface the class property linker
   */
  abstract public function classLinker($class);

  /**
   * Returns a hyperlink object pointing to an API page describing PHP function 
   *
   * @param  string $funName the name of the function
   * @param  string $linkText optional link text
   * @return string hyperlink object pointing to a PHP function page
   */
  abstract public function functionLink($funName, $linkText = null);

  /**
   * Returns a hyperlink object pointing to an API page describing PHP constant 
   * 
   * @param  string $constantName the name of the constant
   * @param  string $linkText optional link text
   * @return string hyperlink object pointing to a PHP constant page
   */
  abstract public function constantLink($constantName, $linkText = null);
}
