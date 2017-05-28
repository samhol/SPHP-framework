<?php

/**
 * ColumnLayoutProperties.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Attributes\MultiValueAttribute;
use Sphp\Html\Foundation\Sites\Core\Screen;

/**
 * Class implements functionality for {@link ColumnInterface} 
 * 
 * Foundation framework based component to create  multi-device layouts
 *
 * The sum of the column widths in a row should never exceed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @link    http://foundation.zurb.com/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ColumnLayoutProperties extends AbstractColumnLayoutProperties {

  public function __construct(MultiValueAttribute $cssClasses) {
    parent::__construct($cssClasses, 12);
  }

}
