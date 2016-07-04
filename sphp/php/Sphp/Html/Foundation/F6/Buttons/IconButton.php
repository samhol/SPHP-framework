<?php

/**
 * CloseButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Span as Span;
use Sphp\Html\Foundation\F6\Foundation as Foundation;

/**
 * Class implements Foundation 6 Close Button in PHP
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://zurb.com/playground/foundation-icon-fonts-3 Foundation Icon Fonts 3
 * @link    http://foundation.zurb.com/sites/docs/button-group.html#split-buttons Foundation 6 Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IconButton extends AbstractComponent implements ButtonInterface {

  use ButtonTrait;

  /**
   *
   * @var Span 
   */
  private $readerSpan;

  /**
   *
   * @var Span 
   */
  private $icon;

  /**
   * Constructs a new instance
   *
   * @param string $icon Foundation Icon Font name
   * @param string $screenReaderText the screen reader-only text
   */
  public function __construct($icon, $screenReaderText = "") {
    parent::__construct("button");
    $this->cssClasses()->lock("button");
    $this->attrs()->lock("type", "button");
    $this->readerSpan = new Span($screenReaderText);
    $this->readerSpan->cssClasses()->lock("show-for-sr");
    //$this->content()->set("show-for-sr", $screenReaderBtn);
    $this->icon = Foundation::icon($icon);
    //$xSpan = new Span($x);
    //$xSpan->attrs()->lock("aria-hidden", "true");
    //$this->content()->set("x-btn", $xSpan);
  }

  /**
   * Sets the screen reader-only text
   * 
   * @param string $screenReaderText the screen reader-only text
   * @return self for PHP Method Chaining
   */
  public function setScreenReaderText($screenReaderText) {
    $this->readerSpan->replaceContent($screenReaderText);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->readerSpan . '<span aria-hidden="true">' . $this->icon . '</span>';
  }

}
