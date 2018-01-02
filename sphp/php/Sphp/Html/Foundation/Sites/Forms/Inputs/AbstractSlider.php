<?php

/**
 * AbstractSlider.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
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
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
    $this->attrs()
            ->demand('data-start')
            ->set('data-start', $start)
            ->demand('data-end')
            ->set('data-end', $end)
            ->demand('data-step')
            ->set('data-step', $step)
            ->demand('data-initial-start')
            ->set('data-initial-start', $start)
            ->demand('data-slider');
    $this->setStepLength($step);
  }

  public function setStepLength(float $step = 1) {
    if ($step <= 0) {
      throw new InvalidStateException('The step value is not positive');
    }
    $length = $this->getMax() - $this->getMin();
    if ($step > $length) {
      throw new InvalidStateException("The step value '$step' exceeds the maximun value '$length'");
    }
    $this->attrs()->set('data-step', $step);
    return $this;
  }

  public function setMin(float $min) {
    $this->attrs()->set('data-start', $min);
    return $this;
  }

  public function getMin(): float {
    return (float) $this->attrs()->getValue('data-start');
  }

  public function setMax(float $max) {
    $this->attrs()->set('data-end', $max);
    return $this;
  }

  public function getMax(): float {
    return (float) $this->attrs()->getValue('data-end');
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
