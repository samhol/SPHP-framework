<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

/**
 * Defines a single header
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Header {

  /**
   * Returns header name
   * 
   * @return string header name
   */
  public function getName(): string;

  /**
   * Returns header value
   * 
   * @return string header value
   */
  public function getValue();

  /**
   * Returns header as a string
   * 
   * @return string header 
   */
  public function __toString(): string;
}
