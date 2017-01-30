<?php

/**
 * TitleBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\AbstractContainerComponent;

/**
 * Implements a Top Bar navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BarContentArea extends AbstractContainerComponent {

  /**
   * Constructs a new instance
   *
   * @param mixed $side the title of the Top Bar component
   */
  public function __construct($side) {
    parent::__construct('div');
    $this->setup($side);
  }

  /**
   * 
   * @param type $side
   * @return self for PHP Method Chaining
   */
  protected function setup($side) {
    $this->cssClasses()->lock("title-bar-$side");
    return $this;
  }

  /**
   * Builds the navigation components
   *
   * @param  mixed $value
   * @return self for PHP Method Chaining
   */
  public function append($value) {
    $this->getInnerContainer()->append($value);
    return $this;
  }

  /**
   * Sets and Returns the title area component
   *
   * @param  mixed $title the title of the Navigator component
   * @return self for PHP Method Chaining
   */
  public function appendOffCanvasOpener(\Sphp\Html\Foundation\Sites\Containers\OffCanvas\OffCanvasOpener $title) {
    $this->append($title);
  }

  /**
   * Sets and Returns the title area component
   *
   * @param  mixed $title the title of the Navigator component
   * @return self for PHP Method Chaining
   */
  public function appendTitle($title) {
    if (!$title instanceof TitleBarTitle) {
      $title = new TitleBarTitle($title);
    }
    $this->append($title);
  }

}
