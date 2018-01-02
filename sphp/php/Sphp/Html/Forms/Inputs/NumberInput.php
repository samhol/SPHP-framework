<?php

/**
 * NumberInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="number"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @link    https://www.w3.org/TR/html-markup/input.number.html W3C reference
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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

  public function setMin(float $min) {
    $this->attrs()->set('min', $min);
    return $this;
  }

  public function setMax(float $max) {
    $this->attrs()->set('max', $max);
    return $this;
  }

  public function getMax(): float {
    return (float) $this->attrs()->getValue('max');
  }

  public function getMin(): float {
    return (float) $this->attrs()->getValue('min');
  }

  public function setStepLength(float $step) {
    $this->attrs()->set('step', $step);
    return $this;
  }

  public function setPlaceholder(string $placeholder = null) {
    $this->attrs()->set('placeholder', $placeholder);
    return $this;
  }

  public function autocomplete(bool $allow = true) {
    $this->attrs()->set('autocomplete', $allow ? 'on' : 'off');
    return $this;
  }

}
