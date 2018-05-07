<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\Span;

/**
 * Implements a Title Bar content area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TitleBarContentArea extends \Sphp\Html\AbstractComponent {

  private $side;

  /**
   *
   * @var MenuButton|null 
   */
  private $menuButton;
  private $title;

  /**
   * Constructor
   *
   * @precondition $side == 'left' | 'right'
   * @param string $side the side of the container
   */
  public function __construct($side) {
    parent::__construct('div');
    $this->side = $side;
    $this->cssClasses()->protect("title-bar-$side");
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
   * @return $this for a fluent interface
   */
  public function setMenuButton(MenuButton $btn) {
    $this->menuButton = $btn;
    return $this;
  }

  /**
   * Sets the title of the Title Bar area component
   *
   * @param  mixed $title the title of the Title Bar area component
   * @return $this for a fluent interface
   */
  public function setTitle($title) {
    $this->title = new Span($title);
    $this->title->cssClasses()->protect('title-bar-title');
    return $this;
  }

  public function contentToString(): string {
    if ($this->side === 'left') {
      return $this->menuButton . 'foobar' . $this->title;
    } else {
      return $this->title . $this->menuButton;
    }
  }

}
