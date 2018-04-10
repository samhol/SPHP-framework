<?php

/**
 * TabInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\Content;

/**
 * Defines a Tab for Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface TabInterface extends Content {

  /**
   * 
   * @return TabController
   */
  public function getTabButton();

  public function setActive(bool $visibility = true);
}
