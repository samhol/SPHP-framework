<?php

/**
 * InputTagTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Trait implements the {@link InputInterface} for input tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait InputTagTrait {

  use InputTrait;

  /**
   * Returns the type attribute value
   *
   * @return string the type attribute value
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   */
  public function getType() {
    return $this->attrs()->getValue('type');
  }

  /**
   * Returns the value of the value attribute.
   *
   * @return string the value of the value attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function getSubmitValue() {
    return $this->attrs()->getValue('value');
  }

  /**
   * Sets the value of the value attribute.
   *
   * @param  string $value the value of the value attribute
   * @param  int $filter The ID of the filter to apply. {@link http://php.net/manual/en/filter.filters.php list of the available filters}.
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function setValue($value, $filter = \FILTER_SANITIZE_FULL_SPECIAL_CHARS) {
    $this->attrs()->set('value', filter_var($value, $filter));
    return $this;
  }

}
