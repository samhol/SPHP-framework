<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\Stdlib\Readers\Json;

/**
 * Implements an JSON attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class JsonAttribute extends AbstractAttribute implements \ArrayAccess {

  /**
   * properties as a (name -> value) map
   *
   * @var scalar[]
   */
  private $data = [];

  /**
   * @var Json
   */
  private $parser;

  /**
   * Constructor
   * 
   * @param string $name the name of the attribute
   * @param scalar|null $value optional value of the attribute
   */
  public function __construct(string $name, $value = null) {
    $this->parser = Parser::json();
    parent::__construct($name);
    if (is_string($value) || is_array($value)) {
      $this->setValue($value);
    }
  }

  public function __destruct() {
    unset($this->data, $this->parser);
  }

  public function __toString(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      if (!$this->isEmpty()) {
        $value = $this->getValue();
        $output .= "='$value'";
      }
    }
    return $output;
  }

  public function isVisible(): bool {
    return $this->isDemanded() || !empty($this->data);
  }

  public function isEmpty(): bool {
    return empty($this->data);
  }

  /**
   * Sets the properties values
   *
   * **IMPORTANT!:** Does not alter locked properties
   *
   * @param  scalar $value the value of the attribute
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if any of the properties has empty name or value
   * @throws ImmutableAttributeException if any of the properties is already locked
   */
  public function setValue($value) {
    try {
      $this->clear();
      if (is_scalar($value)) {
        $this->data = $this->parser->fromString($value);
      } else if (is_array($value)) {
        $this->data = $value;
      }
      //$this->setProperty($this->parser->parse($value));
    } catch (\Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

  public function clear() {
    if (!$this->isProtected()) {
      $this->data = [];
    }
    return $this;
  }

  /**
   * Returns the value of the property attribute as a string
   *
   * **IMPORTANT:**
   *
   * * Returns always `null` if attribute is not set.
   * * **However** might also return `null` for empty attributes.
   *
   * @return scalar the value of the property attribute
   */
  public function getValue() {
    return json_encode($this->data, JSON_UNESCAPED_SLASHES);
  }

  /**
   * Checks whether an option exists
   * 
   * @param  mixed $name option name
   * @return bool true if option exists
   */
  public function offsetExists($name): bool {
    return array_key_exists($name, $this->data);
  }

  /**
   * Returns the option value
   * 
   * @param  mixed $name option name
   * @return scalar|null option value or null if not present
   */
  public function offsetGet($name) {
    if ($this->offsetExists($name)) {
      return $this->data[$name];
    }
    return null;
  }

  /**
   * Sets an option
   * 
   * @param  mixed $name option name
   * @param  mixed $value option value
   * @return void
   * @throws InvalidArgumentException if the name or the value is invalid
   */
  public function offsetSet($name, $value): void {
    if (!is_string($name)) {
      throw new InvalidArgumentException('Invalid type given for option name');
    }
    if (!is_scalar($value) && $value !== null) {
      throw new InvalidArgumentException('Invalid type given for option value');
    }
    if ($value === null) {
      $this->offsetUnset($name);
    } else {
      $this->data[$name] = $value;
    }
  }

  /**
   * Removes an option
   * 
   * @param  mixed $name option name
   * @return void
   */
  public function offsetUnset($name): void {
    if ($this->offsetExists($name)) {
      unset($this->data[$name]);
    }
  }

}
