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
 * Abstract base class for a single header
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class GenericHeader implements Header {

  /**
   * @var string 
   */
  private $name;

  /**
   * @var string 
   */
  private $value;

  public function __construct(string $name, $value) {
    $this->name = $name;
    $this->setValue($value);
  }

  public function getName(): string {
    return $this->name;
  }

  public function getValue() {
    return $this->value;
  }

  /**
   * 
   * @param  string $value
   * @return $this for a fluent interface
   */
  protected function setValue($value) {
    $this->value = $value;
    return $this;
  }

  public function toString() {
    return $this->getName() . ': ' . $this->getValue();
  }

  public function __toString(): string {
    return $this->toString();
  }

  public function execute() {
    header($this->__toString());
  }

}
