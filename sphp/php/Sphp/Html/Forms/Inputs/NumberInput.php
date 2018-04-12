<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="number"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @link    https://www.w3.org/TR/html-markup/input.number.html W3C reference
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class NumberInput extends InputTag implements RangeInput, InputField {

  /**
   * Constructs a new instance
   *
   * @param  string|null $name the value of the  name attribute
   * @param  scalar $value the value of the  value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct(string $name = null, $value = null) {
    parent::__construct('number', $name, $value);
  }

  public function setValue($value) {
    if ($value !== false) {
      $value = (float) $value;
    }
    parent::setValue($value);
    return $this;
  }

  public function setRange(float $min, float $max) {
    $this->attributes()->set('min', $min);
    $this->attributes()->set('max', $max);
    return $this;
  }

  public function getMax(): float {
    return (float) $this->attributes()->getValue('max');
  }

  public function getMin(): float {
    return (float) $this->attributes()->getValue('min');
  }

  public function setStepLength(float $step) {
    $this->attributes()->set('step', $step);
    return $this;
  }

  public function setPlaceholder(string $placeholder = null) {
    $this->attributes()->set('placeholder', $placeholder);
    return $this;
  }

  public function autocomplete(bool $allow = true) {
    $this->attributes()->set('autocomplete', $allow ? 'on' : 'off');
    return $this;
  }

}
