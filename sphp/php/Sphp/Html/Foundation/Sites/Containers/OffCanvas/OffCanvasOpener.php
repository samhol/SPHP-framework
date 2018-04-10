<?php

/**
 * OffCanvasOpener.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Span;

/**
 * Class MenuOpenerButton
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class OffCanvasOpener extends AbstractComponent {

  /**
   *
   * @var Span 
   */
  private $span;

  /**
   * 
   * @param OffCanvasAreaInterface $offCanvas the off-canvas component or its id
   * @param string $screenReaderText
   */
  public function __construct(OffCanvasAreaInterface $offCanvas, $screenReaderText = 'Open menu') {
    parent::__construct('button');
    $this->cssClasses()->protect('menu-icon');
    $this->attributes()->protect('type', 'button')->demand('data-open');
    $this->span = new Span($screenReaderText);
    $this->span->cssClasses()->protect('show-for-sr');
    $this->setCanvas($offCanvas);
  }

  /**
   * 
   * @param  string|OffCanvasAreaInterface $offCanvas the off-canvas component or its id
   * @return $this for a fluent interface
   */
  public function setCanvas($offCanvas) {
    if ($offCanvas instanceof OffCanvasAreaInterface) {
      $offCanvas = $offCanvas->identify();
    }
    $this->attributes()->set('data-open', $offCanvas);
    return $this;
  }

  public function contentToString(): string {
    return $this->span;
  }

}
