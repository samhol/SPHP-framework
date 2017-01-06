<?php

/**
 * TopBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\AbstractComponent;
use InvalidArgumentException;
use Sphp\Html\Div;

/**
 * Implements a Foundation Top Bar navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TopBar extends AbstractComponent {

  /**
   * The topbar Foundation options
   *
   * @var Div
   */
  private $titleArea;

  /**
   *
   * @var Div 
   */
  private $leftArea;

  /**
   *
   * @var Div 
   */
  private $rightArea;

  /**
   * Constructs a new instance
   *
   * @param mixed $title the title of the Top Bar component
   */
  public function __construct($title = null, MenuInterface $left = null, MenuInterface $right = null) {
    parent::__construct('div');
    $this->buildComponents($title, $left, $right);
    $this->cssClasses()->lock('top-bar');
  }

  /**
   * Builds the navigation components
   *
   * @param  mixed $title the title of the Top Bar component
   * @param  null|MenuInterface $leftContent
   * @param  null|MenuInterface $rightContent
   * @return self for PHP Method Chaining
   */
  private function buildComponents($title, MenuInterface $leftContent = null, MenuInterface $rightContent = null) {
    $this->titleArea = new Div($title);
    $this->titleArea->attrs()->classes()->lock('top-bar-title');
    if ($leftContent === null) {
      $leftContent = new DropdownMenu();
    }
    if ($rightContent === null) {
      $rightContent = new DropdownMenu();
    }
    $this->leftArea = new Div();
    $this->leftArea->cssClasses()->lock('top-bar-left');
    $this->rightArea = new Div();
    $this->rightArea->cssClasses()->lock('top-bar-right');
    $this->left($leftContent);
    $this->right($rightContent);
    return $this;
  }

  /**
   * Stacks the buttons in the given screen sizes
   * 
   * @precondition `$screenSize` == `small|medium|large`
   * @param  string $screenSize the targeted screensize
   * @return self for PHP Method Chaining
   * @throws InvalidArgumentException if the `$screenSize` does not match precondition
   */
  public function stackFor($screenSize = 'small') {
    $this->setDefaultStacking();
    if (in_array($screenSize, static::$stackScreens)) {
      if ($screenSize !== 'small') {
        $this->addCssClass("stacked-for-$screenSize");
      }
    } else {
      throw new InvalidArgumentException("Screen size '$screenSize' was not recognized");
    }
    return $this;
  }

  /**
   * Unstacks the stacked buttons in the given screen sizes
   * 
   * @return self for PHP Method Chaining
   * @throws InvalidArgumentException if the `$screenSize` does not match precondition
   */
  public function setDefaultStacking() {
    $this->cssClasses()
            ->remove(['stacked-for-large', 'stacked-for-medium']);
    return $this;
  }

  /**
   * Sets and Returns the title area component
   *
   * @param  mixed $title the title of the Navigator component
   * @return Div the title area component
   */
  public function barTitle($title = null) {
    if ($title !== null) {
      $this->titleArea->replaceContent($title);
    }
    return $this->titleArea;
  }

  /**
   * Sets and Returns the left side menu area component
   *
   * @param  null|MenuInterface $menu
   * @return MenuInterface the left side menu area component
   */
  public function left(MenuInterface $menu = null) {
    if ($menu !== null) {
      $this->leftArea['menu'] = $menu;
    }
    return $this->leftArea['menu'];
  }

  /**
   * Sets and Returns the right side menu area component
   *
   * @param  null|MenuInterface $menu
   * @return MenuInterface the right side menu area component
   */
  public function right(MenuInterface $menu = null) {
    if ($menu !== null) {
      $this->rightArea['menu'] = $menu;
    }
    return $this->rightArea['menu'];
  }

  public function __clone() {
    $this->titleArea = clone $this->titleArea;
    $this->leftArea = clone $this->leftArea;
    $this->rightArea = clone $this->rightArea;
    parent::__clone();
  }

  public function contentToString() {
    return $this->titleArea . $this->leftArea . $this->rightArea;
  }

}
