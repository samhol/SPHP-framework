<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Strings;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;

/**
 * Implements an id attribute for an HTML element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IdAttribute extends AbstractAttribute {

  private ?string $value = null;

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param scalar|null $value
   */
  public function __construct(string $name = 'id', $value = null) {
    parent::__construct($name);
    $this->setValue($value);
  }

  public function isValidValue($value): bool {
    return $value === null || (is_string($value) && Strings::match($value, '/^[A-Za-z]+[\w\-\:\.]*$/'));
  }

  public function __toString(): string {
    $output = '';
    if ($this->isVisible()) {
      $output = $this->getName() . '="' . $this->getValue() . '"';
    }
    return $output;
  }

  public function isVisible(): bool {
    return $this->value !== null;
  }

  public function isEmpty(): bool {
    return $this->value === null;
  }

  /**
   * Returns/Creates an unique identity value
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is 
   * checked for its uniqueness.
   * 
   * @param  string|null $id
   * @return string the identifier
   * @link   https://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function identify(?string $id = null): string {
    if ($id !== null) {
      $this->setValue($id);
    } else if (!$this->isVisible()) {
      $storage = IdStorage::get($this->getName());
      $value = $storage->generateRandom();
      $this->setValue($value);
    }
    return $this->getValue();
  }

  public function setValue($value) {
    if (!$this->isValidValue($value)) {
      throw new InvalidAttributeValueException('Invalid id value provided');
    }
    $this->value = $value;
    return $this;
  }

  public function getValue() {
    return $this->value;
  }

  public function isAlwaysVisible(): bool {
    return false;
  }

}
