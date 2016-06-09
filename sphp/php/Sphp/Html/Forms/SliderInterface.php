<?php

/**
 * SliderInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

/**
 * Class implements jQuery range slider with skin support
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-10-11

 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface SliderInterface extends InputInterface {

  /**
   * Sets the length of the slider step
   *
   * @param  int $step the length of the slider step
   * @return self for PHP Method Chaining
   * @throws \InvalidArgumentException if the step value is below zero
   */
  public function setStepLength($step);

  /**
   * Returns the minimum value of the slider
   *
   * @return int the minimum value of the slider
   */
  public function getMin();

  /**
   * Returns the maximum value of the slider
   *
   * @return int the maximum value of the slider
   */
  public function getMax();
}
