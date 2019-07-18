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
 * Abstract base class for a HTTP header
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractHeader implements Header {

  /**
   * @var string 
   */
  private $name;

  /**
   * Constructor
   * 
   * @param string $name
   */
  public function __construct(string $name) {
    $this->name = $name;
  }

  public function getName(): string {
    return $this->name;
  }

  public function __toString(): string {
    return $this->getName() . ': ' . $this->getValue();
  }

  public function delete(): bool {
    header_remove($this->getName());
  }

  public function save(): bool {
    if (!\headers_sent()) {
      \header((string) $this);
      return true;
    }
    return false;
  }

}
