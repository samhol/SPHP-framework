<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\RangeInput;
use Sphp\Html\Exceptions\InvalidStateException;

/**
 * Slider allows to drag a handle to select a specific value from a range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/slider.html Foundation Sliders
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractSlider extends AbstractComponent implements RangeInput {

  /**
   * Constructs a new instance
   *
   * @param float $start the start value of the slider
   * @param float $end the end value of the slider
   * @param float $step the length of a single step
   */
  public function __construct(float $start = 0, float $end = 100, float $step = 1) {
    parent::__construct('div');
    $this->cssClasses()->protect('slider');
    $this->attributes()
            ->demand('data-start')
            ->demand('data-end')
            ->demand('data-step')
            ->demand('data-initial-start')
            ->set('data-initial-start', $start)
            ->demand('data-slider');
    $this->setRange($start, $end)->setStepLength($step);
  }

  public function setStepLength(float $step = 1) {
    if ($step <= 0) {
      throw new InvalidStateException('The step value is not positive');
    }
    $length = $this->getMax() - $this->getMin();
    if ($step > $length) {
      throw new InvalidStateException("The step value '$step' exceeds the maximun value '$length'");
    }
    $this->attributes()->set('data-step', $step);
    return $this;
  }

  public function setRange(float $min, float $max) {
    $this->attributes()->set('data-start', $min);
    $this->attributes()->set('data-end', $max);
    return $this;
  }

  public function getMin(): float {
    return (float) $this->attributes()->getValue('data-start');
  }

  public function getMax(): float {
    return (float) $this->attributes()->getValue('data-end');
  }

  public function disable(bool $disabled = true) {
    if ($disabled) {
      $this->cssClasses()->set('disabled');
    } else {
      $$this->cssClasses()->remove('disabled');
    }
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->cssClasses()->contains('disabled');
  }

}
