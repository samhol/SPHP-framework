<?php

/**
 * CloseButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Span;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabelable;
use Sphp\Html\Foundation\Sites\Core\Factory;

/**
 * Implements Close Button
 *
 * @author  Sami Holck <sami.holck@gmail.com>
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
   * @var string 
   */
  private $screenReaderLabel;

  /**
   * @var Span 
   */
  private $icon;

  /**
   * Constructs a new instance
   *
   * @param string $icon Foundation Icon Font name
   * @param string $screenReaderLabel the screen reader label or its textual content
   */
  public function __construct(string $icon, string $screenReaderLabel = null) {
    parent::__construct('button');
    $this->cssClasses()->protect('button');
    $this->attributes()->protect('type', 'button');
    $this->setScreenReaderLabel($screenReaderLabel);
    $this->icon = \Sphp\Html\Icons\Icons::fontAwesome($icon);
  }

  public function setScreenReaderLabel(string $label = null) {
    $this->screenReaderLabel = $label;
    return $this;
  }

  public function contentToString(): string {
    return Factory::ScreenReaderLabel($this->screenReaderLabel) . '<span aria-hidden="true">' . $this->icon . '</span>';
  }

}
