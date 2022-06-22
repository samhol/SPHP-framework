<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Exceptions\HtmlException;

/**
 * Implementation of an HTML input type="number" tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @link    https://www.w3.org/TR/html-markup/input.number.html W3C reference
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class NumberInput extends InputTag implements RangeInput {

  /**
   * Constructor
   *
   * @param  string|null $name the value of the  name attribute
   * @param  string|int|float|null $value the value of the  value attribute
   * @link   https://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct(?string $name = null, string|int|float|null $value = null) {
    parent::__construct('number', $name, $value);
  }

  public function setInitialValue($value) {
    if (is_bool($value)) {
      $value = (int) $value;
    } else if (is_string($value) && !is_numeric($value)) {
      throw new HtmlException('Invalid input value for number input');
    }
    if ($value !== null && !is_int($value) && !is_float($value)) {
      $value = (float) $value;
    }
    parent::setInitialValue($value);
    return $this;
  }

  public function setRange(?float $min, ?float $max) {
    $this->attributes()->setAttribute('min', $min);
    $this->attributes()->setAttribute('max', $max);
    return $this;
  }

  public function getMax(): ?float {
    $out = null;
    if ($this->attributeExists('max')) {
      $out = (float) $this->attributes()->getValue('max');
    }
    return $out;
  }

  public function getMin(): ?float {
    $out = null;
    if ($this->attributeExists('min')) {
      $out = (float) $this->attributes()->getValue('min');
    }
    return $out;
  }

  public function setStepLength(?float $step) {
    $this->attributes()->setAttribute('step', $step);
    return $this;
  }

  public function autocomplete(bool $allow = true) {
    $this->attributes()->setAttribute('autocomplete', $allow ? 'on' : 'off');
    return $this;
  }

  public function readOnly(bool $readOnly = true) {
    $this->attributes()->setAttribute('readonly', $readOnly);
    return $this;
  }

}
