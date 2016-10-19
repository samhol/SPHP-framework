<?php

/**
 * TabButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\Lists\LiInterface;
use Sphp\Html\ContainerTag;

/**
 * Description of TabTitle
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TabButton extends AbstractContainerTag implements LiInterface {

  /**
   * Constructs a new instance
   * 
   * @param Tab $tabPanel
   * @param mixed $title
   */
  public function __construct(Tab $tabPanel, $title = null) {
    $innerContainer = new ContainerTag('a', $title);
    $innerContainer->attrs()->lock('href', '#' . $tabPanel->identify());
    parent::__construct('li', null, $innerContainer);
    $this->cssClasses()->lock('tabs-title');
  }

  /**
   * 
   * @param  boolean $active
   * @return self for PHP Method Chaining
   */
  public function setActive($active = true) {
    if ($active) {
      $this->addCssClass('is-active');
    } else {
      $this->removeCssClass('is-active');
    }
    return $this;
  }

}
