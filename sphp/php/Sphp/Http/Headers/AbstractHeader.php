<?php

/**
 * AbstractHeader.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Http\Headers;

/**
 * Abstract base class for a single header
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-16
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractHeader implements HeaderInterface {

  /**
   *
   * @var string 
   */
  private $value;

  public function getValue() {
    return $this->value;
  }

  /**
   * 
   * @param  string $value
   * @return self for a fluent interface
   */
  protected function setValue($value) {
    $this->value = $value;
    return $this;
  }

  public function toString() {
    return $this->getName() . ": " . $this->getValue();
  }

  public function __toString() {
    return $this->toString();
  }

}
