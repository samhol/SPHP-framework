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
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait LabelableTrait {

  /**
   * Creates a {@link Label} component for the input component
   *
   *  **Postcondition:** <var>self::attrExists("id") === true</var>
   *
   * @return Label created label component
   */
  public function createLabel($label = null) {
    if (!($label instanceof Label)) {
      $label = new Label($label, $this);
    } else {
      $label->setFor($this);
    }
    return $label;
  }

}
