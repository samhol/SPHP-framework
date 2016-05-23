<?php

/**
 * LabelableTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

/**
 * A trait implementation of the {@link LabelableInterface}
 *
 * A trait for creating  the {@link Label} component pointing to the html input
 * component that implements the {@link LabelableInterface}.
 *
 * **Important:** This trait requires {@link \Sphp\Html\ComponentInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-05
 * @version 1.0.0
 * @filesource
 */
trait LabelableTrait {

  /**
   * the {@link Label} pointing to this form input component
   *
   * @var Label
   */
  private $label;

  /**
   * Sets the content of the input label ({@link Label})
   *
   * @param  mixed $label the content of the input label ({@link Label})
   * @return self for PHP Method Chaining
   */
  public function setLabel($label) {
    if (!$this->hasId()) {
      $this->identify();
    }
    if (!($label instanceof Label)) {
      $this->label = new Label($label, $this->getId());
    } else {
      $this->label->setFor($this->getId());
    }
    return $this;
  }

  /**
   * Checks whether the {@link Label} is defined for the input component or
   *  not
   *
   * @return boolean true if the label is defined, otherwise false
   * @link   Label
   */
  public function hasLabel() {
    return $this->label instanceof Label;
  }

  /**
   * Creates a {@link Label} component for the input component
   *
   *  **Postcondition:** <var>self::attrExists("id") === true</var>
   *
   * @return Label|null created label component
   */
  public function getLabel() {
    return $this->label;
  }

}
