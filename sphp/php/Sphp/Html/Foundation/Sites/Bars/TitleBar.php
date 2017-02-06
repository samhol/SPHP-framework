<?php

/**
 * TitleBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

/**
 * Implements a Title Bar navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TitleBar extends AbstractBar {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('div', new LeftBarContentArea(), new RightBarContentArea());
    $this->cssClasses()->lock('title-bar');
  }

  /**
   * 
   * @param type $value
   * @param  string $side
   * @return self for PHP Method Chaining
   */
  public function append($value, $side = 'l') {
    if ($side === 'l') {
      $this->left()->append($value);
    } else {
      $this->right()->append($value);
    }
    return $this;
  }

  /**
   * Sets and Returns the title area component
   *
   * @param  mixed $btn the title of the Navigator component
   * @return self for PHP Method Chaining
   */
  public function appendOffCanvasOpener(\Sphp\Html\Foundation\Sites\Containers\OffCanvas\OffCanvasOpener $btn, $side = 'l') {
    if ($side === 'l') {
      $this->left()->setMenuButton($btn);
    } else {
      $this->right()->setMenuButton($btn);
    }
    return $this;
  }

  /**
   * Sets and Returns the title area component
   *
   * @param  mixed $title the title of the Navigator component
   * @return self for PHP Method Chaining
   */
  public function appendTitle($title, $side = 'l') {
    if ($side === 'l') {
      $this->left()->appendTitle($title);
    } else {
      $this->right()->appendTitle($title);
    }
    return $this;
  }

}
