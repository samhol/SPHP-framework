<?php

/**
 * FormRow.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Foundation\Sites\Grids\XY\Row;
use Sphp\Html\Forms\Inputs\InputInterface;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputColumn;
use Sphp\Html\NonVisualContentInterface;
use Sphp\Html\Foundation\Sites\Grids\XY\ColumnInterface;

/**
 * Extends a Foundation Row for form components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FormRow extends Row {

  public function appendColumn($content, array $layout = ['small-12']) {
    //echo "here " . $content;
    if ($content instanceof InputInterface) {
      $this->appendInput($content, $layout);
    } else {
      parent::appendColumn($content, $layout);
    }
    return $this;
  }

  /**
   * Appends a new form input component to the row
   * 
   * @param  InputInterface $input the appended input 
   * @param  array $layout
   * @return $this for a fluent interface
   */
  public function appendInput(InputInterface $input, array $layout = ['small-12']) {
    if ($input instanceof NonVisualContentInterface) {
      $this->append($input);
    } else if ($input instanceof ColumnInterface) {
      $input->layout()->setLayouts($layout);
      $this->append($input);
    } else {
      $this->append(new InputColumn($input, $layout));
    }
    return $this;
  }

}
