<?php

/**
 * FormRow.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Foundation\Sites\Grids\Row;
use Sphp\Html\Forms\Inputs\InputInterface;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputColumn;
use Sphp\Html\NonVisualContentInterface;
use Sphp\Html\Foundation\Sites\Grids\ColumnInterface;

/**
 * Class extends a Foundation Row for form components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-27
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
   * @param InputInterface $input the appended input
   * @param  int $s column width for small screens (1-12)
   * @param  int|boolean $m column width for medium screens (1-12) or false for inheritance
   * @param  int|boolean $l column width for large screens (1-12) or false for inheritance
   * @param  int|boolean $xl column width for x-large screens (1-12) or false for inheritance
   * @param  int|boolean $xxl column width for xx-large screen)s (1-12) or false for inheritance
   * @return $this for a fluent interface
   */
  public function appendInput(InputInterface $input, array $widths = ['small-12']) {
    if ($input instanceof NonVisualContentInterface) {
      $this->append($input);
    } else if ($input instanceof ColumnInterface) {
      $input->layout()->setWidths($widths);
      $this->append($input);
    } else {
      $this->append(new InputColumn($input, $widths));
    }
    return $this;
  }

}
