<?php

/**
 * TabTitleContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\AbstractContainerComponent;

/**
 * Class TabTitleContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TabButtonContainer extends AbstractContainerComponent {

  /**
   * 
   */
  public function __construct() {
    parent::__construct("ul");
    $this->identify();
    $this->cssClasses()->lock("tabs");
    $this->attrs()->demand("data-tabs");
  }

  /**
   * 
   * @param TabButton $panel
   */
  public function append(TabButton $panel) {
    $this->content()->append($panel);
    return $this;
  }

}
