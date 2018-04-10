<?php

/**
 * InputColumnInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Grids\ColumnInterface;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Label;

/**
 * Defines a input column for a Grid system
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface InputColumnInterface extends ColumnInterface, Input {

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
}
