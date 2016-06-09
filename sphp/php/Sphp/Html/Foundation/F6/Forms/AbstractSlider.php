<?php

/**
 * Slider.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Forms\SliderInterface as SliderInterface;
use Sphp\Html\Forms\Input\HiddenInput as HiddenInput;
use Sphp\Html\Forms\Label as Label;
use Sphp\Html\Span as Span;

/**
 * Slider allows to drag a handle to select a specific value from a range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-17
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/slider.html Foundation 6 Sliders
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractSlider extends AbstractComponent implements SliderInterface {

  /**
   * Constructs a new instance
   *
   * @param int $start the start value of the slider
   * @param int $end the end value of the slider
   * @param int $step the length of a single step
   */
  public function __construct($start = 0, $end = 100, $step = 1) {
    parent::__construct("div");
    $this->cssClasses()->lock("slider");
    $this->attrs()
            ->demand("data-start")
            ->set("data-start", $start)
            ->demand("data-end")
            ->set("data-end", $end)
            ->demand("data-step")
            ->set("data-step", $step)
            ->demand("data-initial-start")
            ->set("data-initial-start", $start)
            ->demand("data-slider");
    $this->setStepLength($step);
  }

  /**
   * {@inheritdoc}
   */
  public function setStepLength($step) {
    if ($step <= 0) {
      throw new \InvalidArgumentException("The step value is not positive");
    }
    $length = $this->getMax() - $this->getMin();
    if ($step > $length) {
      throw new \InvalidArgumentException("The step value '$step' exceeds the maximun value '$length'");
    }
    $this->attrs()->set("data-step", $step);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getMin() {
    return $this->attrs()->get("data-start");
  }

  /**
   * {@inheritdoc}
   */
  public function getMax() {
    return $this->attrs()->get("data-end");
  }

}
