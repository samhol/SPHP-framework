<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs\Sliders;

use Sphp\Html\Forms\Inputs\HiddenInput;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\NumberInput;
use Sphp\Html\Span;
use Sphp\Exceptions\InvalidStateException;

/**
 * Slider allows to drag a handle to select a specific value from a range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/slider.html Foundation Sliders
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Slider extends AbstractSlider {

  /**
   * @var Span
   */
  private $handle;

  /**
   * @var HiddenInput
   */
  private $input;

  /**
   * Constructor
   *
   * @param int $start the start value of the slider
   * @param int $end the end value of the slider
   * @param int $value the current value of the slider
   * @param int $step the length of a single step
   */
  public function __construct(int $start = 0, int $end = 100, int $value = 0, int $step = 1) {
    parent::__construct($start, $end, $step);
    $this->handle = new Span();
    $this->handle->cssClasses()->protectValue('slider-handle');
    $this->handle->attributes()
            ->demand('data-slider-handle')
            ->protect('role', 'slider')
            ->protect('tabindex', 1);
    $this->input = new HiddenInput();
    $this->setStepLength($step)->setInitialValue($value);
  }

  public function __destruct() {
    unset($this->handle, $this->input);
    parent::__destruct();
  }

  /**
   * Returns the form element containing the value of the slider
   * 
   * @return Input the form element containing the value of the slider
   */
  private function getInput(): Input {
    return $this->input;
  }

  /**
   * Sets the slider orientation to vertical
   * 
   * @return $this for a fluent interface
   */
  public function setVertical(bool $vertical = true) {
    if ($vertical) {
      $this->cssClasses()->add('vertical');
      $this->attributes()->setAttribute('data-vertical', 'true');
    } else {
      $this->cssClasses()->remove('vertical');
      $this->attributes()->setAttribute('data-vertical', 'false');
    }
    return $this;
  }

  public function disable(bool $disabled = true) {
    parent::disable($disabled);
    $this->getInput()->disable($disabled);
    return $this;
  }

  public function getName(): ?string {
    return $this->getInput()->getName();
  }

  public function setName(string $name = null) {
    $this->getInput()->setName($name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->getInput()->isNamed();
  }

  public function getMin(): float {
    return $this->attributes()->getValue('data-start');
  }

  public function getMax(): float {
    return $this->attributes()->getValue('data-end');
  }

  public function getSubmitValue() {
    return $this->getInput()->getSubmitValue();
  }

  public function setInitialValue($value) {
    if ($this->getMin() > $value || $this->getMax() < $value) {
      throw new InvalidStateException("value: '$value' is not in valid range ({$this->getMin()}-{$this->getMax()})");
    }
    $this->getInput()->setInitialValue($value);
    $this->attributes()->setAttribute('data-initial-start', $value);
    return $this;
  }

  public function contentToString(): string {
    return $this->handle . '<span class="slider-fill" data-slider-fill></span>';
  }

  /**
   * Binds input component for the slider value
   * 
   * @param  Input|null $input
   * @return Input
   */
  public function bindInput(Input $input = null): Input {
    if ($input === null) {
      $input = new NumberInput();
    }
    $this->input = $input;
    $this->input->setName($this->getName());
    $this->handle->attributes()->setAttribute('aria-controls', $input->identify());
    return $input;
  }

}
