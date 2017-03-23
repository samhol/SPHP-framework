<?php

/**
 * TopBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use InvalidArgumentException;
use Sphp\Html\Div;

/**
 * Implements a Top Bar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TopBar extends AbstractBar {

  /**
   * The topbar Foundation options
   *
   * @var Div
   */
  private $titleArea;

  /**
   * Constructs a new instance
   *
   * @param mixed $title the title of the Top Bar component
   */
  public function __construct($title = null, BarContentArea $left = null, BarContentArea $right = null) {
    if ($left === null) {
      $left = new BarContentArea('div');
    }
    $left->cssClasses()->lock('top-bar-left');
    if ($right === null) {
      $right = new BarContentArea('div');
    }
    $right->cssClasses()->lock('top-bar-right');
    parent::__construct('div', $left, $right);
    $this->barTitle($title);
    $this->cssClasses()->lock('top-bar');
  }

  public function __destruct() {
    unset($this->titleArea);
    parent::__destruct();
  }

  public function __clone() {
    $this->titleArea = clone $this->titleArea;
    parent::__clone();
  }

  /**
   * Stacks the buttons in the given screen sizes
   * 
   * @precondition `$screenSize` == `small|medium|large`
   * @param  string $screenSize the targeted screensize
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   */
  public function setDefaultStacking() {
    $this->cssClasses()
            ->remove(['stacked-for-large', 'stacked-for-medium']);
    return $this;
  }

  /**
   * Sets and Returns the title area component
   *
   * @param  mixed $title the title content of the Navigator component
   * @return self for a fluent interface
   */
  public function barTitle($title = null) {
    if ($title !== null) {
      $this->titleArea = new Div($title);
      $this->titleArea->attrs()->classes()->lock('top-bar-title');

      $this->titleArea->replaceContent($title);
    } else {
      $this->titleArea = null;
    }
    return $this;
  }

  public function contentToString() {
    $output = '';
    if ($this->titleArea !== null) {
      $output .= $this->titleArea->getHtml();
    }
    return $output . parent::contentToString();
  }

}
