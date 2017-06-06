<?php

/**
 * AbstractArrowOnlyButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabelable;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabel;

/**
 * Implements a Close Button
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://zurb.com/playground/foundation-icon-fonts-3 Foundation Icon Fonts 3
 * @link    http://foundation.zurb.com/sites/docs/button-group.html#split-buttons Foundation 6 Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractArrowOnlyButton extends AbstractComponent implements ButtonInterface, ScreenReaderLabelable {

  use ButtonTrait;

  /**
   * the inner label for screen reader text
   *
   * @var ScreenReaderLabel
   */
  private $screenReaderLabel;

  /**
   * Constructs a new instance
   *
   * @param  ScreenReaderLabel|string $screenReaderLabel the screen reader label or its textual content
   */
  public function __construct($screenReaderLabel = '') {
    parent::__construct('button');
    $this->cssClasses()
            ->lock('button dropdown arrow-only');
    $this->screenReaderLabel = new ScreenReaderLabel();
    $this->setScreenReaderLabel($screenReaderLabel);
  }

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
    return $this->screenReaderLabel->getHtml();
  }

}
