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

use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Stdlib\Parsers\Json;

/**
 * Implements an JSON attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class JsonAttribute extends AbstractMutableAttribute {

  /**
   * properties as a (name -> value) map
   *
   * @var mixed
   */
  private $data;
  private Json $parser;

  /**
   * Constructor
   * 
   * @param string $name the name of the attribute
   * @param mixed $value optional value of the attribute
   */
  public function __construct(string $name, $value = null) {
    $this->parser = ParseFactory::json();
    parent::__construct($name);
    $this->setValue($value);
  }

  public function __destruct() {
    unset($this->data, $this->parser);
  }

  public function __toString(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      $value = $this->getValue();
      if (!$value !== null) {
        $output .= "='$value'";
      }
    }
    return $output;
  }

  public function isVisible(): bool {
    return $this->isAlwaysVisible() || $this->data !== null;
  }

  public function isEmpty(): bool {
    return empty($this->data);
  }

  public function isValidValue($value): bool {
    $valid = false;
    if (is_string($value) && (new \Sphp\Validators\JsonString())->isValid($value)) {
      $valid = true;
    } else if (is_array($value) || is_object($value)) {
      $is = json_encode($value, JSON_NUMERIC_CHECK, 512);
      $valid = $is !== null;
    } else if (is_null($value)) {
      $valid = true;
    }
    return $valid;
  }

  public function setValue($value) {
    if (!$this->isValidValue($value)) {
      throw new InvalidAttributeValueException('Invalid data type for Json attribute');
    }
    $this->data = $value;
    return $this;
  }

  public function clear() {
    $this->data = null;
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
    if (is_string($this->data)) {
      $out = $this->data;
    } else if (is_array($this->data) || is_object($this->data)) {
      $out = json_encode($this->data, JSON_BIGINT_AS_STRING | JSON_NUMERIC_CHECK | JSON_HEX_TAG);
    } else {
      $out = null;
    }
    return $out;
  }

}
