<?php

/**
 * FormattableString.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Config\ErrorHandling\ErrorExceptionThrower;
/**
 * Description of FormattableString
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-06-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FormattableString implements FormattableStringInterface {

  /**
   * original raw format
   *
   * @var string
   */
  private $format;

  /**
   * arguments
   *
   * @var scalar[]
   */
  private $args;

  /**
   *
   * @var int 
   */
  private $count = 0;

  /**
   * Constructs a new instance
   *
   * @param string $format
   * @param  array $args optional arguments
   */
  public function __construct(string $format, array $args = []) {
    $this->format = $format;
    $this->setArguments($args);
  }

  public function __toString(): string {
    try {
      return $this->format();
    } catch (\Throwable $ex) {
      return $this->getFormat();
    }
  }

  public function getFormat() {
    return $this->format;
  }

  public function setArguments(array $args) {
    $this->args = $args;
    return $this;
  }

  public function hasArguments(): bool {
    return $this->count > 0;
  }

  public function getArguments(): array {
    return $this->args;
  }

  public function format(array $args = null): string {
    $thrower = new ErrorExceptionThrower();
    $thrower->start();
    if ($args === null) {
      $args = $this->getArguments();
    }
    $result = vsprintf($this->getFormat(), $args);
    $thrower->stop();
    return $result;
  }

}
