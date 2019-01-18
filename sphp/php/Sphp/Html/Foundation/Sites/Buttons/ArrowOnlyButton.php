<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Core\ScreenReaderLabelable;
use Sphp\Html\Foundation\Foundation;

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
   * Constructor
   *
   * @param string $screenReaderLabel the screen reader label text
   */
  public function __construct(string $screenReaderLabel = null) {
    parent::__construct('button');
    $this->cssClasses()
            ->protectValue('button dropdown arrow-only');
    $this->setScreenReaderLabel($screenReaderLabel);
    $this->setScreenReaderLabel($screenReaderLabel);
  }

  public function setScreenReaderLabel(string $label = null) {
    $this->screenReaderLabel = $label;
    return $this;
  }

  public function contentToString(): string {
    return Foundation::screenReaderLabel($this->screenReaderLabel)->getHtml();
  }

}
