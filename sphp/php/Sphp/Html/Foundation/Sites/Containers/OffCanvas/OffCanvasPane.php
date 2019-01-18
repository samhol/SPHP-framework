<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\Foundation\Sites\Buttons\CloseButton;

/**
 * An abstract implementation of on Off-canvas area
 * 
 * This component is the panel that slides in and out of the {@link OffCanvas} when activated. 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/off-canvas.html Foundation 6 Off-canvas
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class OffCanvasPane extends AbstractContainerTag implements OffCanvasAreaInterface {

  /**
   *
   * @var CloseButton
   */
  private $closeButton;

  /**
   * Constructor
   *
   * @param string $side
   * @param string $position
   */
  public function __construct($side, $position = 'fixed') {
    parent::__construct('div');
    $this->attributes()->demand('data-off-canvas');
    $this->identify();
    $this->closeButton = new CloseButton();
    $this->setSide($side)
            ->setPosition($position);
  }

  /**
   * 
   * @param  string $position
   * @return $this for a fluent interface
   */
  protected function setSide($position) {
    $this->cssClasses()->protectValue("position-$position");
    return $this;
  }

  /**
   * 
   * @param  string $position
   * @return $this for a fluent interface
   */
  protected function setPosition($position = 'fixed') {
    if ($position !== 'fixed') {
      $this->cssClasses()->setValue("off-canvas-$position");
    } else {
      $this->cssClasses()->setValue("off-canvas");
    }
    return $this;
  }

  public function contentToString(): string {
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
