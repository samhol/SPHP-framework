<?php

/**
 * LabelableTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\Attributes\AttributeManager as AttributeManager;

/**
 * A trait implementation of the {@link LabelableInputInterface}
 *
 * A trait for creating  the {@link Label} component pointing to the html input
 * component that implements the {@link LabelableInterface}.
 *
 * **Important:** This trait requires {@link \Sphp\Html\ComponentInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   * Returns the attribute manager attached to the component
   *
   * @return AttributeManager the attribute manager
   */
  abstract public function attrs();

  /**
   * Sets the content of the input label ({@link Label})
   *
   * @param  mixed $label the content of the input label ({@link Label})
   * @return self for PHP Method Chaining
   */
  public function setLabel($label) {
    if (!$this->attrs()->exists("id")) {
      $this->attrs()->setUnique("id");
    }
    if (!($label instanceof Label)) {
      $this->label = new Label($label, $this);
    } else {
      $this->label->setFor($this);
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
