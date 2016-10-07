<?php

/**
 * TabContentContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\AbstractContainerComponent;

/**
 * Description of TabContentContainer
 *
 * @author Sami Holck
 */
class TabContentContainer extends AbstractContainerComponent {

  /**
   *
   * @var TabButtonContainer
   */
  private $tabs;

  /**
   * 
   * @param TabButtonContainer $tabs
   */
  public function __construct(TabButtonContainer $tabs = null) {
    parent::__construct('div');
    if ($tabs === null) {
      $tabs = new TabButtonContainer();
    }
    $this->tabs = $tabs;
    $this->cssClasses()->lock('tabs-content');
    $this->attrs()->set('data-tabs-content', $this->tabs->identify());
  }

  /**
   * 
   * @param Tab $panel
   */
  public function append(Tab $panel) {
    $this->content()->append($panel);
    $this->tabs->append($panel->getTabButton());
    return $this;
  }

  /**
   * 
   * @return TabButtonContainer
   */
  public function getTabButtons() {
    return $this->tabs;
  }
  
  /**
   * 
   * @param type $match
   * @return \Sphp\Html\Foundation\F6\Containers\Tabs\TabContentContainer
   */
  public function matchHeight($match = true) {
    $value = $match ? 'true' : 'false';
    $this->attrs()->set('data-match-height', $value);
    return $this;
  }

}
