<?php

/**
 * OffCanvasArea.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\Foundation\Sites\Navigation\VerticalMenu;
use Sphp\Html\Foundation\Sites\Buttons\CloseButton;
use Sphp\Html\Foundation\Sites\Navigation\SubMenu;

/**
 * An abstract implementation of on Off-canvas area
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
class OffCanvasArea extends AbstractContainerTag implements OffCanvasAreaInterface {

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
  public function __construct($position, $content = null) {
    parent::__construct('div');
    $this->attrs()->demand('data-off-canvas');
    $this->cssClasses()->lock('off-canvas');
    $this->identify();
    $this->closeButton = new CloseButton();
    $this->setPosition($position) ;
  }

  /**
   * 
   * @param  string $position
   * @return self for PHP Method Chaining
   */
  public function setPosition($position) {
    $this->cssClasses()->lock("position-$position");
    return $this;
  }

  public function contentToString() {
    return $this->closeButton->getHtml() . parent::contentToString();
  }

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
