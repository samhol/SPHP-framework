<?php

/**
 * Radioboxes.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * A component containing multiple {@link Radiobox} inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Radioboxes extends Choiceboxes {

  /**
   * Constructs a new instance
   *
   * @param string $name the value of the name attribute
   * @param scalar[] $values
   * @param mixed $mainLabel
   */
  public function __construct(string $name = null, array $values = []) {
    parent::__construct('input:radio', $name, $values);
  }

  /**
   * Sets the current submission set of the input component
   *
   * @param string|string[] $value the current submission set of the input component
   * @return $this for a fluent interface
   */
  public function setSubmitValue($value) {
    if (!is_array($value)) {
      $value = array_pop($value);
    }
    foreach ($this->getOptionFields() as $opt) {
      if ($opt->getAttr('value') == $value) {
        $opt->setChecked(true);
      } else {
        $opt->setChecked(false);
      }
    }
    return $this;
  }

  /**
   * Returns the current submission set of the input component
   *
   * @return string|null the current submission set of the input component
   */
  public function getSubmitValue() {
    $value = parent::getValue();
    if (count($value) > 0) {
      return array_pop($value);
    }
  }

  /**
   * Sets whether one of the {@link Radiobox} components must be checked or 
   * not before form submission
   * 
   * @param  boolean $required true if one of the {@link Radiobox} components 
   *         must be checked before form submission, otherwise false
   * @return $this for a fluent interface
   */
  public function setRequired(bool $required = true) {
    foreach ($this->getOptionFields() as $opt) {
      $opt->setRequired($required);
    }
    return $this;
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, 
   *         otherwise false
   */
  public function isRequired(): bool {
    foreach ($this->getOptionFields() as $opt) {
      if (!$opt->isRequired()) {
        return false;
      }
    }
    return true;
  }

}
