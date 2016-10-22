<?php

/**
 * OffCanvas.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Div;

/**
 * Class implemnets Foundation Off-canvas navigation component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-09-15
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/offcanvas.html Foundation Off-canvas
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class OffCanvas extends AbstractComponent {

  /**
   *
   * @var boolean
   */
  private $useLeftMenu = false;

  /**
   *
   * @var boolean
   */
  private $useRightMenu = false;

  /**
   *
   * @var Div 
   */
  private $innerWrapper;

  /**
   *
   * @var Div 
   */
  private $leftOffCanvas;

  /**
   *
   * @var Div 
   */
  private $rightOffCanvas;

  /**
   *
   * @var Div 
   */
  private $offCanvasContent;

  /**
   * Constructs a new instance
   *
   * @param  string $title the main title of the component
   */
  public function __construct($title = "") {
    parent::__construct('div');
    $this->cssClasses()->lock('off-canvas-wrapper');
    $this->innerWrapper = new Div();
    $this->innerWrapper->cssClasses()->lock('off-canvas-wrapper-inner');
    $this->innerWrapper->attrs()->demand('data-off-canvas-wrapper');
    $this->leftOffCanvas = new OffCanvasArea();
    $this->leftOffCanvas->cssClasses()->lock('off-canvas position-left');
    $this->rightOffCanvas = new OffCanvasArea();
    $this->rightOffCanvas->cssClasses()->lock('off-canvas position-right');
    $this->innerWrapper['left'] = $this->leftOffCanvas;
    $this->innerWrapper['right'] = $this->rightOffCanvas;
    $this->offCanvasContent = new Div();
    $this->offCanvasContent->cssClasses()->lock("off-canvas-content");
    $this->offCanvasContent->attrs()->demand('data-off-canvas-content');
    $this->innerWrapper['content'] = $this->offCanvasContent;
  }

  /**
   * 
   * @return Div
   */
  protected function getInnerWrap() {
    return $this->innerWrapper;
  }

  /**
   * 
   * @return OffCanvasArea
   */
  public function leftMenu() {
    return $this->getInnerWrap()['left'];
  }

  /**
   * Returns the left Off-canvas menu
   * 
   * @return OffCanvasArea
   */
  public function rightMenu() {
    return $this->getInnerWrap()['right'];
  }

  /**
   * Sets the title of the Off-canvas
   * 
   * @param  string $heading
   * @return self for PHP Method Chaining
   */
  public function setTitle($heading) {
    $this->getTabBar()['middle'][0]->replaceContent($heading);
    return $this;
  }

  /**
   * Sets either the left or the right root menu of the Off-canvas
   * 
   * @param  AbstractRootMenu $menu the off-canvas menu
   * @return self for PHP Method Chaining
   */
  public function setMenu(AbstractRootMenu $menu) {
    if ($menu instanceof LeftMenu) {
      $this->getInnerWrap()['left-off-canvas-menu'] = $menu;
      $this->useLeftMenu(true);
    } else {
      $this->getInnerWrap()['right-off-canvas-menu'] = $menu;
      $this->useRightMenu(true);
    }
    return $this;
  }

  /**
   * Sets the visibility of the left root menu
   * 
   * @param  boolean $use true if the menu is visible and false otherwise
   * @return self for PHP Method Chaining
   */
  public function useLeftMenu($use = true) {
    $this->useLeftMenu = $use;
    if ($this->useLeftMenu) {
      $this->getTabBar()['left'] = $this->leftMenu()->getMenuButton();
    } else {
      $this->getTabBar()['left'] = '';
    }
    return $this;
  }

  /**
   * Sets the visibility of the right root menu
   * 
   * @param  boolean $use true if the menu is visible and false otherwise
   * @return self for PHP Method Chaining
   */
  public function useRightMenu($use = true) {
    $this->useRightMenu = $use;
    if ($this->useRightMenu) {
      $this->getTabBar()["right"] = $this->rightMenu()->getMenuButton();
    } else {
      $this->getTabBar()["right"] = "";
    }
    return $this;
  }

  /**
   * Returns the Off-canvas content container component
   * 
   * @return Div the Off-canvas content container component
   */
  public function mainContent() {
    return $this->offCanvasContent;
  }
  
  public function contentToString() {
    return $this->innerWrapper->getHtml();
  }

}
