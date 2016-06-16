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
  //abstract public function attrs();

  /**
   * Creates a {@link Label} component for the input component
   *
   *  **Postcondition:** <var>self::attrExists("id") === true</var>
   *
   * @return Label|null created label component
   */
  public function createLabel($label = null) {
    if (!$this->attrs()->exists("id")) {
      $this->attrs()->setUnique("id");
    }
    if (!($label instanceof Label)) {
      $label = new Label($label, $this);
    } else {
      $label->setFor($this);
    }
    return $label;
  }

}
