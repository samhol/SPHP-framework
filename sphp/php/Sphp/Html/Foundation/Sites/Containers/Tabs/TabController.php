<?php

/**
 * TabButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\ContainerTag;

/**
 * Implements a Tab controller for Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TabController extends AbstractContainerTag implements TabControllerInterface {

  /**
   * Constructs a new instance
   * 
   * @param Tab $tabPanel
   * @param mixed $title
   */
  public function __construct(Tab $tabPanel, $title = null) {
    $innerContainer = new ContainerTag('a', $title);
    $innerContainer->attributes()->protect('href', '#' . $tabPanel->identify());
    parent::__construct('li', null, $innerContainer);
    $this->cssClasses()->protect('tabs-title');
  }

  public function setActive(bool $active = true) {
    if ($active) {
      $this->attributes()->setAria('aria-selected', 'true');
      $this->addCssClass('is-active');
    } else {
      $this->attributes()->remove('aria-selected');
      $this->removeCssClass('is-active');
    }
    return $this;
  }

}
