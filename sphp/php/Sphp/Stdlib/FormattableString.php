<?php

/**
 * FormattableString.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\InvalidArgumentException;

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
    $pattern = "~%(?:(\d+)[$])?[-+]?(?:[ 0]|['].)?(?:[-]?\d+)?(?:[.]\d+)?[%bcdeEufFgGosxX]~";
    $expected = [];
    preg_match_all($pattern, $this->format, $expected);
    $this->count = isset($expected[0]) ? count($expected[0]) : 0;
    $this->setArguments($args);
  }

  public function __toString(): string {
    return $this->format();
  }

  public function getFormat() {
    return $this->format;
  }

  /**
   * 
   * @param array $args
   * @return $this
   * @throws InvalidArgumentException
   */
  public function setArguments(array $args) {
    if (count($args) < $this->count) {
      throw new InvalidArgumentException('The number of arguments in the string does not match the number of arguments in a template');
    }
    $this->args = $args;
    return $this;
  }

  public function countArguments(): int {
    return $this->count;
  }

  public function hasArguments(): bool {
    return $this->count > 0;
  }

  public function getArguments(): array {
    return $this->args;
  }

  public function format(array $args = null): string {
    if ($args === null) {
      $args = $this->getArguments();
    } else if (count($args) < $this->countArguments()) {
      throw new InvalidArgumentException('The number of arguments in the string does not match the number of arguments in a template');
    }
    if ($this->hasArguments()) {
      $result = vsprintf($this->getFormat(), $args);
    } else {
      $result = $this->getFormat();
    }
    return $result;
  }

}
