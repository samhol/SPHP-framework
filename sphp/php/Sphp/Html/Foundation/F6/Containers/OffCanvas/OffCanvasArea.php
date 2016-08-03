<?php

/**
 * OffCanvasArea.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\OffCanvas;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Foundation\F6\Navigation\VerticalMenu as VerticalMenu;
use Sphp\Html\Foundation\F6\Buttons\CloseButton as CloseButton;
use Sphp\Html\Foundation\F6\Navigation\SubMenu as SubMenu;
use Sphp\Html\Forms\Buttons\ButtonTag as Button;

/**
 * An abstract implementation of Foundation Off-canvas menu
 * 
 * {@link self} is the panel that slides in and out of the {@link OffCanvas} when activated. 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-09-15
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/off-canvas.html Foundation 6 Off-canvas
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class OffCanvasArea extends AbstractComponent implements OffCanvasAreaInterface {

  /**
   *
   * @var VerticalMenu
   */
  private $menu;

  /**
   *
   * @var CloseButton
   */
  private $closeButton;

  /**
   * Constructs a new instance
   *
   * @param string $tagname
   */
  public function __construct() {
    parent::__construct("div");
    $this->attrs()->demand("data-off-canvas");
    $this->identify();
    $this->menu = new VerticalMenu();
    $this->closeButton = new CloseButton();
  }

  /**
   * 
   * @param type $text
   * @return self for PHP Method Chaining
   */
  public function appendLabel($text) {
    $this->menu->appendText($text);
    return $this;
  }

  /**
   * @return self for PHP Method Chaining
   */
  public function appendLink($href, $content, $target = null) {
    $this->menu->appendLink($href, $content, $target);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function appendSubMenu(SubMenu $link = null) {
    return $this->menu->appendSubMenu($link);
  }

  public function contentToString() {
    return $this->closeButton . $this->menu;
  }

  /**
   * {@inheritdoc}
   */
  public function getMenuButton($button = null) {
    if ($button === null) {
      $button = new OffCanvasOpener($this);
    }
    if ($button instanceof OffCanvasOpener) {
      $button->setCanvas($this);
    }
    return $button;
  }

}
