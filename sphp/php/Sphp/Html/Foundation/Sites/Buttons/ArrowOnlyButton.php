<?php

/**
 * ArrowOnlyButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabelable;
use Sphp\Html\Foundation\Sites\Core\Factory;

/**
 * Implements a Close Button
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://zurb.com/playground/foundation-icon-fonts-3 Foundation Icon Fonts 3
 * @link    http://foundation.zurb.com/sites/docs/button-group.html#split-buttons Foundation 6 Buttons
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ArrowOnlyButton extends AbstractComponent implements ButtonInterface, ScreenReaderLabelable {

  use ButtonTrait;

  /**
   * the inner label for screen reader text
   *
   * @var string
   */
  private $screenReaderLabel;

  /**
   * Constructs a new instance
   *
   * @param string $screenReaderLabel the screen reader label text
   */
  public function __construct(string $screenReaderLabel = null) {
    parent::__construct('button');
    $this->cssClasses()
            ->protect('button dropdown arrow-only');
    $this->setScreenReaderLabel($screenReaderLabel);
    $this->setScreenReaderLabel($screenReaderLabel);
  }

  public function setScreenReaderLabel(string $label = null) {
    $this->screenReaderLabel = $label;
    return $this;
  }

  public function contentToString(): string {
    return Factory::screenReaderLabel($this->screenReaderLabel)->getHtml();
  }

}
