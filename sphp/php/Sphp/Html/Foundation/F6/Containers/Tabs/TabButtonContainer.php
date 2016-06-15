<?php

/**
 * TabTitleContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

/**
 * Class TabTitleContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-07
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TabButtonContainer extends \Sphp\Html\AbstractContainerComponent {

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
