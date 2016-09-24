<?php

/**
 * InputColumnInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Forms\Inputs;

use Sphp\Html\Foundation\F6\Grids\ColumnInterface;
use Sphp\Html\Forms\Inputs\InputInterface;
use Sphp\Html\Forms\Label;

/**
 * Interface defines a Foundation based input column for a Grid system
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface InputColumnInterface extends ColumnInterface, InputInterface {

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
   * @return self for PHP Method Chaining
   */
  public function setLabel($label);
}
