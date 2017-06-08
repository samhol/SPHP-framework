<?php

/**
 * Checkboxes.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Stdlib\Strings;

/**
 * A component containing multiple {@link Checkbox} inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Checkboxes extends Choiceboxes {

  /**
   * Constructs a new instance
   *
   * @param string $name the value of the name attribute
   * @param scalar[] $values
   * @param mixed $mainLabel
   */
  public function __construct($name, array $values = []) {
    parent::__construct('input:checkbox', $name, $values);
  }

  /**
   * Sets the value of name attribute
   *
   * @param  string $name the value of the name attribute
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function setName($name) {
    if (!Strings::endsWith($name, '[]')) {
      $name .= '[]';
    }
    parent::setName($name);
    return $this;
  }

  /**
   * Returns the value of name attribute
   *
   * @return string the value of the name attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function getName() {
    $name = parent::getName();
    return str_replace('[]', '', $name);
  }

  /**
   * Sets whether an {@link Checkbox} component must be checked before form 
   *   submission
   * 
   * @param  boolean $required true if an {@link Checkbox} component must
   *         be checked before form submission, otherwise false
   * @return self for a fluent interface
   */
  public function setRequired(bool $required = true) {
    return $this->setAttr('data-required', $required);
  }

  /**
   * Checks whether an {@link Checkbox} component must be checked before form 
   *   submission
   *
   * @return boolean true if an {@link Checkbox} component must be checked 
   *         before form submission, otherwise false
   */
  public function isRequired(): bool {
    return $this->attrExists('data-required');
  }

}
