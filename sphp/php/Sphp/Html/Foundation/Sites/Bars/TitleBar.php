<?php

/**
 * TitleBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\AbstractComponent;

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
class TitleBar extends AbstractComponent {

  /**
   *
   * @var BarContentArea 
   */
  private $leftArea;

  /**
   *
   * @var BarContentArea 
   */
  private $rightArea;

  /**
   * Constructs a new instance
   *
   * @param mixed $title the title of the Top Bar component
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->lock('title-bar');
    $this->leftArea = new BarContentArea('left');
    $this->rightArea = new BarContentArea('right');
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
      $this->left()->appendOffCanvasOpener($btn);
    } else {
      $this->right()->appendOffCanvasOpener($btn);
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
  
  /**
   * Sets and Returns the left side menu area component
   *
   * @return BarContentArea the left side menu area component
   */
  public function left() {
    return $this->leftArea;
  }

  /**
   * Sets and Returns the right side menu area component
   *
   * @return MenuInterface the right side menu area component
   */
  public function right() {
    return $this->rightArea;
  }

  public function __clone() {
    $this->leftArea = clone $this->leftArea;
    $this->rightArea = clone $this->rightArea;
    parent::__clone();
  }

  public function contentToString() {
    return $this->leftArea->getHtml() . $this->rightArea->getHtml();
  }

}
