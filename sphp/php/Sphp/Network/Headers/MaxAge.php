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
 * Implements a MaxAge header
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MaxAge extends AbstractHeader {

  /**
   * @var string 
   */
  private $value;
  /**
   * Constructor
   * 
   * @param int $value
   */
  public function __construct(int $value) {
    parent::__construct('Access-Control-Max-Age', $value);
  }
  /**
   * 
   * @param  string $value
   * @return $this for a fluent interface
   */
  protected function setValue(int $value) {
    $this->value = $value;
    return $this;
  }

  public function getValue() {
    return $value;
  }

}
