<?php

/**
 * TabButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\Lists\LiInterface;
use Sphp\Html\Navigation\Hyperlink;

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
class TabButton extends AbstractContainerComponent implements LiInterface {

  /**
   *
   * @var Tab 
   */
  private $panel;

  /**
   * 
   * @var Hyperlink
   */
  private $panelLink;

  /**
   * 
   * @param Tab $tabPanel
   * @param mixed $title
   */
  public function __construct(Tab $tabPanel, $title = null) {
    parent::__construct('li');
    $this->cssClasses()->lock("tabs-title");
    $this->panel = $tabPanel;
    $this->panel->getId();
    $this->panelLink = new Hyperlink("#" . $this->panel->getId(), $title);
    $this->setContentContainer($this->panelLink);
  }

}
