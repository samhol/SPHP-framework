<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Defines a mutable HTML attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface MutableAttribute extends Attribute {

  /**
   * Sets the value of the attribute
   *
   * @param  mixed $value value to set
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the attribute value is invalid for the type of the attribute 
   */
  public function setValue($value);

  /**
   * Clears attribute value
   *
   * @return $this for a fluent interface
   */
  public function clear();
}
