<?php

/**
 * MenuOpenerButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\OffCanvas;

use Sphp\Html\Span as Span;

/**
 * Class MenuOpenerButton
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class OffCanvasOpener extends \Sphp\Html\AbstractComponent {

  /**
   *
   * @var Span 
   */
  private $span;

  /**
   * 
   * @param string|OffCanvasAreaInterface $offCanvas the off-canvas component or its id
   * @param string $screenReaderText
   */
  public function __construct($offCanvas, $screenReaderText = "Open menu") {
    parent::__construct("button");
    $this->cssClasses()->lock("menu-icon");
    $this->attrs()->lock("type", "button")->demand("data-open");
    $this->span = new Span($screenReaderText);
    $this->span->cssClasses()->lock("show-for-sr");
    $this->setCanvas($offCanvas);
  }

  /**
   * 
   * @param  string|OffCanvasAreaInterface $offCanvas the off-canvas component or its id
   * @return self for PHP Method Chaining
   */
  public function setCanvas($offCanvas) {
    if ($offCanvas instanceof OffCanvasAreaInterface) {
      $offCanvas = $offCanvas->getId();
    }
    $this->attrs()->set("data-open", $offCanvas);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->span;
  }

}
