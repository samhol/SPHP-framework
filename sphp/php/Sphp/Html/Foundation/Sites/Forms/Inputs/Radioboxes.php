<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\ValidableInput;

/**
 * A component containing multiple radio inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Radioboxes extends Choiceboxes implements ValidableInput {

  /**
   * Constructor
   *
   * @param string $name
   * @param array $values
   * @param mixed $legend
   */
  public function __construct(string $name = null, array $values = [], $legend = null) {
    parent::__construct('radio', $name, $values, $legend);
  }

  /**
   * Sets the current submission set of the input component
   *
   * @param  mixed $value the current submission set of the input component
   * @return $this for a fluent interface
   */
  public function setInitialValue($value) {
    foreach ($this->getOptionFields() as $opt) {
      if ($opt->getAttribute('value') == $value) {
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
