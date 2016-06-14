<?php

/**
 * FormGridTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Foundation\F6\Core\GridTrait as GridTrait;

/**
 * Trait implements {@link GridInterface} to be used with {@link FormInterface} etc.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-24
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait FormGridTrait {

  use GridTrait;

  /**
   * Returns all {@link InputColumn} components from the grid
   * 
   * @return Container containing all the {@link InputColumn} components
   */
  public function getInputColumns() {
    return $this->getComponentsByObjectType(InputColumn::class);
  }

}
