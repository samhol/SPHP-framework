<?php

/**
 * TitleBarContentArea.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\Span;

/**
 * Implements a Title Bar content area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TitleBarContentArea extends BarContentArea {

  private $side;

  /**
   *
   * @var MenuButton|null 
   */
  private $menuButton;
  private $title;

  /**
   * Constructs a new instance
   *
   * @precondition $side == 'left' | 'right'
   * @param string $side the side of the container
   */
  public function __construct($side) {
    parent::__construct('div');
    $this->side = $side;
    $this->cssClasses()->lock("title-bar-$side");
  }

  public function __destruct() {
    unset($this->menuButton, $this->title);
    parent::__destruct();
  }

  public function __clone() {
    if ($this->menuButton !== null) {
      $this->menuButton = clone $this->menuButton;
    }
    if ($this->title !== null) {
      $this->title = clone $this->title;
    }
    parent::__clone();
  }

  /**
   * Sets and Returns the title area component
   *
   * @param  MenuButton $btn the menu controller button
   * @return self for a fluent interface
   */
  public function setMenuButton(MenuButton $btn) {
    $this->menuButton = $btn;
    return $this;
  }

  /**
   * Sets the title of the Title Bar area component
   *
   * @param  mixed $title the title of the Title Bar area component
   * @return self for a fluent interface
   */
  public function setTitle($title) {
    $this->title = new Span($title);
    $this->title->cssClasses()->lock('title-bar-title');
    return $this;
  }

  public function contentToString() {
    if ($this->side === 'left') {
      return $this->menuButton . $this->title . parent::contentToString();
    } else {
      return parent::contentToString() . $this->title . $this->menuButton;
    }
  }

}
