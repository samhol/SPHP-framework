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

  /**
   * @var OffCanvasPane[]
   */
  private $panes;

  /**
   * @var Div
   */
  private $offCanvasContent;
  private $canvases = 0;

  /**
   * Constructor
   * 
   * @param int $position
   */
  public function __construct(int $position) {
    parent::__construct('div');
    $this->canvases = $position;
    $this->createCanvases();
    $this->cssClasses()->protectValue('off-canvas-wrapper');
    $this->offCanvasContent = new Div();
    $this->offCanvasContent->cssClasses()->protectValue('off-canvas-content');
    $this->offCanvasContent->attributes()->demand('data-off-canvas-content');
  }

  public function __destruct() {
    unset($this->offCanvasContent, $this->panes);
    parent::__destruct();
  }

  protected function createCanvases() {
    $this->panes = [];
    if (($this->canvases & self::LEFT) === self::LEFT) {
      $this->panes[self::LEFT] = new BasicOffCanvasPane(self::LEFT);
    }
    if (($this->canvases & self::RIGHT) === self::RIGHT) {
      $this->panes[self::RIGHT] = new BasicOffCanvasPane(self::RIGHT);
    }
    if (($this->canvases & self::TOP) === self::TOP) {
      $this->panes[self::TOP] = new BasicOffCanvasPane(self::TOP);
    }
    if (($this->canvases & self::BOTTOM) === self::BOTTOM) {
      $this->panes[self::BOTTOM] = new BasicOffCanvasPane(self::BOTTOM);
    }
  }

  public function setPane(int $name): ?OffCanvasPane {
    if (!array_key_exists($name, $this->panes)) {
      throw new LogicException('%s pane is not initialized');
    }
    return $this->panes[$name];
  }

  public function getPane(int $name): ?OffCanvasPane {
    if (!array_key_exists($name, $this->panes)) {
      throw new LogicException('%s pane is not initialized');
    }
    return $this->panes[$name];
  }

  /**
   * Returns the left Off-canvas pane
   * 
   * @return OffCanvasPane|null
   */
  public function left(): ?OffCanvasPane {
    return $this->getPane(self::LEFT);
  }

  /**
   * Returns the right Off-canvas pane
   * 
   * @return OffCanvasPane|null
   */
  public function right(): ?OffCanvasPane {
    return $this->getPane(self::RIGHT);
  }

  /**
   * Returns the top Off-canvas pane
   * 
   * @return OffCanvasPane|null
   */
  public function top(): ?OffCanvasPane {
    return $this->getPane(self::RIGHT);
  }

  /**
   * Returns the bottom Off-canvas pane
   * 
   * @return OffCanvasPane|null
   */
  public function bottom(): ?OffCanvasPane {
    return $this->getPane(self::RIGHT);
  }

  /**
   * Returns the Off-canvas content container component
   * 
   * @return Div the Off-canvas content container component
   */
  public function mainContent(): Div {
    return $this->offCanvasContent;
  }

  public function contentToString(): string {
    $output = implode($this->panes);
    $output .= $this->offCanvasContent;
    return $output;
  }

}
