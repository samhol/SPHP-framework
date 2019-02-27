<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Foundation\Sites\Forms\Inputs\BasicInputCell;
use Sphp\Html\NonVisualContent;
use Sphp\Html\Foundation\Sites\Grids\Cell;

/**
 * Extends a Foundation Row for form components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FormRow extends BasicRow {

  public function __construct($columns = null, $sizes = []) {
    parent::__construct($columns, $sizes);
    $this->layout()->usePadding(true);
  }

  /**
   * Appends a new form input component to the row
   * 
   * @param  Input $input the appended input 
   * @param  array $layout
   * @return $this for a fluent interface
   */
  public function appendInput(Input $input, array $layout = ['auto']): Cell {
    if ($input instanceof Cell) {
      $input->layout()->setLayouts($layout);
      $this->append($input);
    } else {
      $input = new BasicInputCell($input);
      $input->layout()->setLayouts($layout);
      $this->append(new BasicInputCell($input, $layout));
    }
    return $input;
  }

}
