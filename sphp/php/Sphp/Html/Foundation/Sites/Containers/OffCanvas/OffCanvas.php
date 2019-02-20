<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Div;

/**
 * Implements Off-canvas navigation component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/offcanvas.html Foundation Off-canvas
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class OffCanvas extends AbstractComponent {

  /**
   * 
   */
  const LEFT = 0b1;
  const RIGHT = 0b10;
  const TOP = 0b100;
  const BOTTOM = 0b1000;

  private $panes;

  /**
   * @var OffCanvasPane 
   */
  private $left;

  /**
   *
   * @var OffCanvasPane 
   */
  private $right;

  /**
   *
   * @var OffCanvasPane 
   */
  private $top;

  /**
   *
   * @var OffCanvasPane 
   */
  private $bottom;

  /**
   *
   * @var Div
   */
  private $offCanvasContent;
  private $canvases = 0;

  /**
   * Constructor
   */
  public function __construct(int $position) {
    parent::__construct('div');
    $this->canvases = $position;
    $this->createCanvases();
    $this->cssClasses()->protectValue('off-canvas-wrapper');
    $this->offCanvasContent = new Div();
    $this->offCanvasContent->cssClasses()->protectValue("off-canvas-content");
    $this->offCanvasContent->attributes()->demand('data-off-canvas-content');
  }

  protected function createCanvases() {
    $this->panes = [];
    if (($this->canvases & self::LEFT) === self::LEFT) {
      $this->panes['left'] = new OffCanvasPane('left');
    }
    if (($this->canvases & self::RIGHT) === self::RIGHT) {
      $this->panes['right'] = new OffCanvasPane('right');
    }
    if (($this->canvases & self::TOP) === self::TOP) {
      $this->panes['top'] = new OffCanvasPane('top');
    }
    if (($this->canvases & self::BOTTOM) === self::BOTTOM) {
      $this->panes['bottom'] = new OffCanvasPane('bottom');
    }
  }

  public function __call(string $name, array $arguments) {
    if (!array_key_exists($name, $this->panes)) {
      throw new LogicException('%s pane is not initialized');
    }
    return $this->panes[$name];
  }

  /**
   * 
   * @return OffCanvasPane
   */
  public function leftMenu() {
    if ($this->left === null) {
      $this->left = new OffCanvasPane('left', $this->position);
    }
    return $this->left;
  }

  /**
   * Returns the left Off-canvas menu
   * 
   * @return OffCanvasPane
   */
  public function rightMenu() {
    if ($this->right === null) {
      $this->right = new OffCanvasPane('right', $this->position);
    }
    return $this->right;
  }

  /**
   * Sets the title of the Off-canvas
   * 
   * @param  string $heading
   * @return $this for a fluent interface
   */
  public function setTitle($heading) {
    $this->getTabBar()['middle'][0]->resetContent($heading);
    return $this;
  }

  /**
   * Sets either the left or the right root menu of the Off-canvas
   * 
   * @param  AbstractRootMenu $menu the off-canvas menu
   * @return $this for a fluent interface
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
   * @return $this for a fluent interface
   */
  public function useLeftMenu($use = true) {
    $this->useLeftMenu = $use;
    if ($this->useLeftMenu) {
      $this->getTabBar()['left'] = $this->leftMenu()->getOpener();
    } else {
      $this->getTabBar()['left'] = '';
    }
    return $this;
  }

  /**
   * Sets the visibility of the right root menu
   * 
   * @param  boolean $use true if the menu is visible and false otherwise
   * @return $this for a fluent interface
   */
  public function useRightMenu($use = true) {
    $this->useRightMenu = $use;
    if ($this->useRightMenu) {
      $this->getTabBar()["right"] = $this->rightMenu()->getOpener();
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

  public function contentToString(): string {
    $output = implode($this->panes);
    $output .= $this->offCanvasContent;
    return $output;
  }

}
