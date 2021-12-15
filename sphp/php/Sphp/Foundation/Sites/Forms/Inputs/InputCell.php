<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Forms\Inputs;

use Sphp\Foundation\Sites\Grids\Cell;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Label;

/**
 * Defines a input column for a Grid system
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface InputCell extends Cell {

  /**
   * Returns the label of the component
   * 
   * @return Label the label of the component
   */
  public function getLabel();

  /**
   * Sets the visible contents of the input label
   * 
   * @param  mixed $label the contents of the label 
   * @return $this for a fluent interface
   */
  public function setLabel($label);

  /**
   * Returns the actual input component
   * 
   * @return Input the actual input component
   */
  public function getInput(): Input;
}
