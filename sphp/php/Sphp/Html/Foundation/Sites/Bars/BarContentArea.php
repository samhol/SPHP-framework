<?php

/**
 * BarContentArea.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\AbstractContainerComponent;

/**
 * Implements a Title Bar contetn area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class BarContentArea extends AbstractContainerComponent {

  private $menuButton;

  /**
   * Constructs a new instance
   *
   * @param mixed $side the title of the Top Bar component
   */
  public function __construct() {
    parent::__construct('div');
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
   * @param  MenuButton $btn the menu controller button
   * @return self for PHP Method Chaining
   */
  public function setMenuButton(MenuButton $btn) {
    $this->menuButton = $btn;
    return $this;
  }

  /**
   * Sets and Returns the title area component
   *
   * @return MenuButton|null the menu controller button or null if not set
   */
  public function getMenuButton() {
    return $this->menuButton;
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