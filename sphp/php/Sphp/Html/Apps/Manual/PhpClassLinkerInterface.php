<?php

/**
 * PhpClassLinkerInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\Hyperlink;

/**
 * Link generator pointing to an existing API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface PhpClassLinkerInterface extends LinkerInterface {

  /**
   * Returns a hyperlink object pointing to an API class page
   *
   * @param  null|string $name optional alternative class link content
   * @return Hyperlink hyperlink object pointing to an API class page
   */
  public function getLink($name = null);

  /**
   * Returns a hyperlink object pointing to class method in the API documentation
   *
   * @param  string $method the method name
   * @param  boolean $full true for `Class::method()` and false for `method()`
   * @return Hyperlink object pointing to class method in the API documentation
   */
  public function method($method, $full = false);

  /**
   * Returns a hyperlink object pointing to class constant in the API documentation
   *
   * @param  string $constName the constant name
   * @return Hyperlink object pointing to class constant in the API documentation
   */
  public function constant($constName);

  /**
   * Returns a hyperlink object pointing to the namespace of the class in the API documentation
   *
   * @param  string $constName the constant name
   * @return Hyperlink object pointing to class constant in the API documentation
   */
  public function namespaceLink();
}
