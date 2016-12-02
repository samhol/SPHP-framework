<?php

/**
 * LabelableInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms;

/**
 * Defines features for all labelable components
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface LabelableInterface {

  /**
   * Returns the {@link Label} component attached to the component
   *
   * @return Label|null attached label component or null
   */
  public function createLabel();
}
