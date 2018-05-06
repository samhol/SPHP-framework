<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Throwable;

/**
 * Trait implements parts of the {@link Content} interface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait ContentTrait {

  /**
   * Returns the component as HTML markup string
   *
   * @return string HTML markup of the component
   * @throws \Sphp\Exceptions\SphpException if HTML parsing fails
   */
  public abstract function getHtml(): string;

  /**
   * Returns the component as HTML markup string
   *
   * @return string HTML markup of the object
   */
  public function __toString(): string {
    try {
      $output = $this->getHtml();
    } catch (Throwable $e) {
      $output = $e->getMessage();
    }
    return $output;
  }

  /**
   * Prints the component as HTML markup string
   *
   * @return $this for a fluent interface
   */
  public function printHtml() {
    echo $this;
    return $this;
  }

}
