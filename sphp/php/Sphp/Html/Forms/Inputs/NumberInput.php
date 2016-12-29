<?php

/**
 * NumberInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="number"&gt; tag
 *
 * {@inheritdoc}
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @link    https://www.w3.org/TR/html-markup/input.number.html W3C reference
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class NumberInput extends InputTag implements NumberInputInterface {

  use ValidableInputTrait;

  /**
   * Constructs a new instance
   *
   * @precondition  `0 < $size <= $maxlength`
   * @param  string|null $name the value of the  name attribute
   * @param  string $value the value of the  value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct($name = null, $value = null) {
    parent::__construct('number', $name, $value);
  }

  public function setValue($value) {
    if ($value !== false) {
      $value = (int) $value;
    }
    parent::setValue($value);
    return $this;
  }

  public function getMinimum() {
    return $this->attrs()->get('min');
  }

  public function setMinimum($min) {
    $this->attrs()->set('min', (int) $min);
    return $this;
  }

  public function getMaximum() {
    return $this->attrs()->get('max');
  }

  public function setMaximum($max) {
    $this->attrs()->set('max', (int) $max);
    return $this;
  }

  public function getStep() {
    return $this->attrs()->get('step');
  }

  public function setStep($step) {
    $this->attrs()->set('step', (int) $step);
    return $this;
  }

  public function setPlaceholder($placeholder) {
    $this->attrs()->set('placeholder', $placeholder);
    return $this;
  }

  public function autocomplete($allow = true) {
    $this->attrs()->set('autocomplete', $allow ? 'on' : 'off');
    return $this;
  }

}
