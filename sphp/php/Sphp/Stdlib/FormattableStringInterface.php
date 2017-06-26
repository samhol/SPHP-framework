<?php

/**
 * FormattableString.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

/**
 * Description of FormattedString
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-06-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface FormattableStringInterface {

  /**
   * Sets the arguments used
   *
   * @param  array $args the arguments
   * @return self for a fluent interface
   */
  public function setArguments(array $args);

  /**
   *
   * @return boolean true if the object has arguments, false otherwise
   */
  public function hasArguments(): bool;

  /**
   * Returns the arguments used
   *
   * @return array $args the arguments
   */
  public function getArguments(): array;

  /**
   * Returns the formatted string
   *
   * @return string the formatted string
   */
  public function __toString(): string;
}
