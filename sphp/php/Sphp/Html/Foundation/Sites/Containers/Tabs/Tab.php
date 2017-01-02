<?php

/**
 * Tab.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\AbstractContainerTag;

/**
 * Implements a Foundation Tab for Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Tab extends AbstractContainerTag implements TabInterface {

  /**
   *
   * @var TabController 
   */
  private $tabButton;

  /**
   * Constructs a new instance
   * 
   * @param mixed $tab the tab button content
   * @param type $content the tab content
   */
  public function __construct($tab = null, $content = null) {
    parent::__construct('div');
    $this->identify();
    $this->cssClasses()->lock("tabs-panel");
    if ($content !== null) {
      $this->append($content);
    }
    $this->tabButton = new TabController($this, $tab);
  }

  /**
   * 
   * @return TabController
   */
  public function getTabButton() {
    return $this->tabButton;
  }

  public function setActive($visibility = true) {
    if ($visibility) {
      $this->addCssClass('is-active');
    } else {
      $this->removeCssClass('is-active');
    }
    $this->tabButton->setActive($visibility);
    return $this;
  }

}
