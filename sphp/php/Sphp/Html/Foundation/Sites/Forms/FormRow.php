<?php

/**
 * FormRow.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Foundation\Sites\Grids\Row;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputColumn;
use Sphp\Html\NonVisualContent;
use Sphp\Html\Foundation\Sites\Grids\ColumnInterface;

/**
 * Extends a Foundation Row for form components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FormRow extends Row {

  
  public function __construct($columns = null, $sizes = null) {
    parent::__construct($columns, $sizes);
    $this->layout()->usePadding(true);
  }
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
   * @param  Input $input the appended input 
   * @param  array $layout
   * @return $this for a fluent interface
   */
  public function appendInput(Input $input, array $layout = ['small-12']) {
    if ($input instanceof NonVisualContent) {
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
