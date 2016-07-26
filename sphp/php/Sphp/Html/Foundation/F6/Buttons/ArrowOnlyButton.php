<?php

/**
 * ArrowOnlyButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Foundation\F6\Core\ScreenReaderLabel as ScreenReaderLabel;

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
class ArrowOnlyButton extends AbstractComponent implements ButtonInterface {

  use ButtonTrait;

  /**
   * the inner label for screen reader text
   *
   * @var ScreenReaderLabel
   */
  private $screeReaderLabel;

  /**
   * Constructs a new instance
   *
   * @param string $screenReaderText the screen reader-only text
   */
  public function __construct($screenReaderText = "") {
    parent::__construct("button");
    $this->cssClasses()
            ->lock("button dropdown arrow-only");
    $this->screeReaderLabel = new ScreenReaderLabel($screenReaderText);
  }
  
  /**
   * Returns the inner label for screen reader text
   * 
   * @return ScreenReaderLabel the inner label for screen reader text
   */
  public function getScreeReaderLabel() {
    return $this->screeReaderLabel;
  }

  
  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->screeReaderLabel->getHtml();
  }

}
