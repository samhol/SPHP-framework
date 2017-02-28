<?php

/**
 * TabControllerInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\Lists\LiInterface;

/**
 * Defines a Tab controller for Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TabControllerInterface extends LiInterface {

  /**
   * Sets the Tab controller active/inactive
   * 
   * @param  boolean $active true for active and false for inactive
   * @return self for a fluent interface
   */
  public function setActive($active = true);
}
