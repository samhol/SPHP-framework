<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
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
    if (!\headers_sent()) {
      header_remove($this->getName());
      return true;
    }
    return false;
  }

  public function save(): bool {
    if (!\headers_sent()) {
      \header((string) $this, false);
      return true;
    }
    return false;
  }

  /**
   * Replaces a HTTP header
   * 
   */
  public function reset() {
    if (!\headers_sent()) {
      \header((string) $this, true);
      return true;
    }
    return false;
  }

}
