<?php

/**
 * FormattableString.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

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
   * original raw message
   *
   * @var string
   */
  private $string;

  /**
   * original raw message arguments
   *
   * @var scalar[]
   */
  private $args;

  /**
   * Constructs a new instance
   *
   * @param string $string
   * @param  array $args optional arguments
   */
  public function __construct(string $string, array $args = []) {
    $this->string = $string;
    $this->setArguments($args);
  }

  public function __toString(): string {
    if ($this->hasArguments()) {
      return vsprintf($this->getRawString(), $this->getArguments());
    } else {
      return $this->getRawString();
    }
  }

  public function getRawString() {
    return $this->string;
  }

  public function setArguments(array $args) {
    $this->args = $args;
    return $this;
  }

  public function hasArguments(): bool {
    return !empty($this->args);
  }

  public function getArguments(): array {
    return $this->args;
  }

}
