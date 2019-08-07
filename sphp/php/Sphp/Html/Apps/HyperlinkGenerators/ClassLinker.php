<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use Sphp\Html\Navigation\A;

/**
 * Defines a Hyperlink object generator pointing to an online PHP API
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ClassLinker extends Linker {

  /**
   * Returns a hyperlink object pointing to an API class page
   *
   * @param  null|string $name optional alternative class link content
   * @return A hyperlink object pointing to an API class page
   */
  public function getLink(string $name = null): A;

  /**
   * Returns a hyperlink object pointing to class method in the API documentation
   *
   * @param  string $method the method name
   * @param  boolean $full true for `Class::method()` and false for `method()`
   * @return A object pointing to class method in the API documentation
   */
  public function methodLink(string $method, bool $full = false): A;

  /**
   * Returns a hyperlink object pointing to class constant in the API documentation
   *
   * @param  string $constName the constant name
   * @return A object pointing to class constant in the API documentation
   */
  public function constantLink(string $constName): A;

  /**
   * Returns a hyperlink object pointing to the namespace of the class in the API documentation
   *
   * @return A object pointing to the namespace of the class in the API documentation
   */
  public function namespaceLink(): A;
}
