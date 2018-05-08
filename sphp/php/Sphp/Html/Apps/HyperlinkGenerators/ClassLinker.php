<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use Sphp\Html\Navigation\Hyperlink;

/**
 * Defines a Hyperlink object generator pointing to an online PHP API
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ClassLinker extends LinkerInterface {

  /**
   * Returns a hyperlink object pointing to an API class page
   *
   * @param  null|string $name optional alternative class link content
   * @return Hyperlink hyperlink object pointing to an API class page
   */
  public function getLink(string $name = null): Hyperlink;

  /**
   * Returns a hyperlink object pointing to class method in the API documentation
   *
   * @param  string $method the method name
   * @param  boolean $full true for `Class::method()` and false for `method()`
   * @return Hyperlink object pointing to class method in the API documentation
   */
  public function methodLink(string $method, bool $full = false): Hyperlink;

  /**
   * Returns a hyperlink object pointing to class constant in the API documentation
   *
   * @param  string $constName the constant name
   * @return Hyperlink object pointing to class constant in the API documentation
   */
  public function constantLink(string $constName): Hyperlink;

  /**
   * Returns a hyperlink object pointing to the namespace of the class in the API documentation
   *
   * @return Hyperlink object pointing to the namespace of the class in the API documentation
   */
  public function namespaceLink(): Hyperlink;
}
