<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Forms\Inputs\Sliders;

use Sphp\Foundation\Sites\Core\JavaScript\AbstractJavaScriptComponent;
use Sphp\Html\Forms\Inputs\RangeInput;
use Sphp\Exceptions\InvalidStateException;

/**
 * Slider allows to drag a handle to select a specific value from a range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/slider.html Foundation Sliders
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractSlider extends AbstractJavaScriptComponent implements RangeInput {

  //use Data
  /**
   * Constructor
   *
   * @param float $start the start value of the slider
   * @param float $end the end value of the slider
   * @param float $step the length of a single step
   */
  public function __construct(float $start = 0, float $end = 100, float $step = 1) {
    parent::__construct('div');
    $this->cssClasses()->protectValue('slider');
    $this->attributes()
            ->forceVisibility('data-start')
            ->forceVisibility('data-end')
            ->forceVisibility('data-step')
            ->forceVisibility('data-initial-start')
            ->setAttribute('data-initial-start', $start)
            ->forceVisibility('data-slider');
    $this->setRange($start, $end)->setStepLength($step);
  }

  public function setStepLength(?float $step) {
    if ($step <= 0) {
      throw new InvalidStateException('The step value is not positive');
    }
    $length = $this->getMax() - $this->getMin();
    if ($step > $length) {
      throw new InvalidStateException("The step value '$step' exceeds the maximun value '$length'");
    }
    $this->attributes()->setAttribute('data-step', $step);
    return $this;
  }

  public function setRange(?float $min, ?float $max) {
    $this->attributes()->setAttribute('data-start', $min);
    $this->attributes()->setAttribute('data-end', $max);
    return $this;
  }

  public function getMin(): ?float {
    return (float) $this->attributes()->getValue('data-start');
  }

  public function getMax(): ?float {
    return (float) $this->attributes()->getValue('data-end');
  }

  public function disable(bool $disabled = true) {
    if ($disabled) {
      $this->addCssClass('disabled');
    } else {
      $$this->removeCssClass('disabled');
    }
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->hasCssClass('disabled');
  }

}
