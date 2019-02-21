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
use Sphp\Html\Foundation\Sites\Controllers\CloseButton;
use Sphp\Html\Component;
use Sphp\Html\Foundation\Sites\Controllers\MenuButton;

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
class BasicOffCanvasPane extends AbstractContainerTag implements OffCanvasPane {

  /**
   * @var CloseButton
   */
  private $closeButton;

  /**
   * @var string[] 
   */
  private static $map = [
      Offcanvas::TOP => 'top',
      Offcanvas::RIGHT => 'right',
      Offcanvas::BOTTOM => 'bottom',
      Offcanvas::LEFT => 'left'];
  private $side;

  /**
   * Constructor
   *
   * @param int $side
   * @param string $position
   */
  public function __construct(int $side, string $position = 'fixed') {
    $this->side = $side;
    parent::__construct('div');
    $this->attributes()->demand('data-off-canvas');
    $this->identify();
    $this->closeButton = new CloseButton();
    $this->setPosition($position);
    $this->cssClasses()->protectValue("position-" . self::$map[$this->side]);
  }

  public function getSide(): int {
    return $this->side;
  }

  public function setPosition(string $position = 'fixed') {
    if ($position !== 'fixed') {
      $this->cssClasses()->add("off-canvas-$position");
    } else {
      $this->cssClasses()->add("off-canvas");
    }
    return $this;
  }

  public function contentToString(): string {
    return $this->closeButton->getHtml() . parent::contentToString();
  }

  public function createToggleButton(Component $seed = null): Component {
    if ($seed === null) {
      $button = new MenuButton('Open menu');
    }
    $id = $this->identify();
    $button->setAttribute('data-toggle', $id);
    return $button;
  }

}
