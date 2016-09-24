<?php

/**
 * Tab.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\AbstractContainerTag;

/**
 * Description of TabPanel
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Tab extends AbstractContainerTag {

  /**
   *
   * @var TabButton 
   */
  private $tabButton;

  /**
   * 
   * @param type $tab
   * @param type $content
   */
  public function __construct($tab = null, $content = null) {
    parent::__construct("div");
    $this->identify();
    $this->cssClasses()->lock("tabs-panel");
    if ($content !== null) {
      $this->append($content);
    }
    $this->tabButton = new TabButton($this, $tab);
  }

  /**
   * 
   * @return TabButton
   */
  public function getTabButton() {
    return $this->tabButton;
  }

}
