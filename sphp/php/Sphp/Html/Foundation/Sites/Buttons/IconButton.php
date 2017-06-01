<?php

/**
 * CloseButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Span;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabelable;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabel;
use Sphp\Html\Foundation\Sites\Foundation;

/**
 * Implements Close Button
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://zurb.com/playground/foundation-icon-fonts-3 Foundation Icon Fonts 3
 * @link    http://foundation.zurb.com/sites/docs/button-group.html#split-buttons Foundation 6 Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IconButton extends AbstractComponent implements ButtonInterface, ScreenReaderLabelable {

  use ButtonTrait;

  /**
   * the inner label for screen reader text
   *
   * @var ScreenReaderLabel
   */
  private $screenReaderLabel;

  /**
   *
   * @var Span 
   */
  private $icon;

  /**
   * Constructs a new instance
   *
   * @param string $icon Foundation Icon Font name
   * @param  ScreenReaderLabel|string $screenReaderLabel the screen reader label or its textual content
   */
  public function __construct($icon, $screenReaderLabel = "") {
    parent::__construct('button');
    $this->cssClasses()->lock('button');
    $this->attrs()->lock('type', 'button');
    $this->screenReaderLabel = new ScreenReaderLabel();
    $this->setScreenReaderLabel($screenReaderLabel);
    $this->icon = Foundation::icon($icon);
  }

  /**
   * Sets the screen reader-only label
   * 
   * @param  ScreenReaderLabel|string $label the screen reader label or its textual content
   * @return self for a fluent interface
   */
  public function setScreenReaderLabel($label) {
    if ($label instanceof ScreenReaderLabel) {
      $this->screenReaderLabel = $label;
    } else {
      $this->screenReaderLabel->replaceContent($label);
    }
    return $this;
  }

  public function getScreeReaderLabel() {
    return $this->screenReaderLabel;
  }

  public function contentToString(): string {
    return $this->screenReaderLabel . '<span aria-hidden="true">' . $this->icon . '</span>';
  }

}
