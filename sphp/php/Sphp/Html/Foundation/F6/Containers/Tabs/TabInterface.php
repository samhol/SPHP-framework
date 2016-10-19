<?php

/**
 * TabInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\ContentInterface;

/**
 * Interface defines a Foundation Tab for Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TabInterface extends ContentInterface {

  /**
   * 
   * @return TabController
   */
  public function getTabButton();

  /**
   * {@inheritdoc}
   */
  public function setActive($visibility = true);
}
