<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Strings;

/**
 * Implements a unique id for an HTML element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IdAttribute extends ScalarAttribute {

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param string|null $value
   */
  public function __construct(string $name = 'id', string $value = null) {
    parent::__construct($name);
    if ($value !== null) {
      $this->setValue($value);
    }
  }

  public function isValidValue($value): bool {
    return $value === null || $value === false || (is_string($value) && Strings::match($value, '/^[^\s]+$/'));
  }

  public function __toString(): string {
    $output = '';
    if ($this->isVisible()) {
      $output = $this->getName() . '="' . $this->getValue() . '"';
    }
    return $output;
  }

  public function isVisible(): bool {
    return !$this->isEmpty();
  }

  /**
   * Returns/Creates an unique identity value
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   * 
   * @param  bool $forceNewValue true for forsing a new unique id value, and false otherwise
   * @return string the identifier
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function identify(bool $forceNewValue = false): string {
    if ($forceNewValue || !$this->isVisible()) {
      $storage = IdStorage::get($this->getName());
      $value = $storage->generateRandom();
      $this->setValue($value);
    }
    return $this->getValue();
  }

}
