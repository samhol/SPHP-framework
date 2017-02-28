<?php

/**
 * OffCanvasArea.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\Foundation\Sites\Buttons\CloseButton;

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
class OffCanvasPane extends AbstractContainerTag implements OffCanvasAreaInterface {

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
  public function __construct($side, $position = 'fixed') {
    parent::__construct('div');
    $this->attrs()->demand('data-off-canvas');
    $this->identify("$side-off-canvas");
    $this->closeButton = new CloseButton();
    $this->setSide($side)
            ->setPosition($position) ;
  }

  /**
   * 
   * @param  string $position
   * @return self for a fluent interface
   */
  protected function setSide($position) {
    $this->cssClasses()->lock("position-$position");
    return $this;
  }


  /**
   * 
   * @param  string $position
   * @return self for a fluent interface
   */
  protected function setPosition($position = 'fixed') {
    if ($position !== 'fixed') {
      $this->cssClasses()->set("off-canvas-$position");
    } else {
      $this->cssClasses()->set("off-canvas");
    }
    return $this;
  }

  public function contentToString() {
    return $this->closeButton->getHtml() . parent::contentToString();
  }

  public function getOpener($content = null) {
    if ($content === null) {
      $button = new OffCanvasOpener($this);
    }
    if ($button instanceof OffCanvasOpener) {
      $button->setCanvas($this);
    }
    return $button;
  }

}
