<?php

/**
 * FormGridTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Foundation\F6\Core\GridTrait as GridTrait;
use Sphp\Html\Foundation\F6\Core\Row as Row;

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
   * Returns the input as an array of {@link Row} components
   *
   * **Important:**
   * 
   * * `$row` not extending {@link Row} is wrapped inside a {@link Row} component.
   *
   * @param  mixed|Row $row a row content or a row component
   * @return Row wrapped row component
   */
  public function toRow($row) {
    if (!($row instanceof Row)) {
      return new FormRow($row);
    } else {
      return $row;
    }
  }

  /**
   * Returns all {@link InputColumn} components from the grid
   * 
   * @return Container containing all the {@link InputColumn} components
   */
  public function getInputColumns() {
    return $this->getComponentsByObjectType(InputColumn::class);
  }

}
