<?php

/**
 * FormRow.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Foundation\F6\Grids\AbstractRow as AbstractRow;
use Sphp\Html\Forms\Inputs\InputInterface as InputInterface;
use Sphp\Html\Foundation\F6\Forms\Inputs\InputColumn as InputColumn;

/**
 * Class extends a Foundation Row for form components
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-27
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FormRow extends AbstractRow {

  /**
   * {@inheritdoc}
   */
  public function appendColumn($content, $small = 12, $medium = false, $large = false, $xlarge = false, $xxlarge = false) {
    //echo "here " . $content;
    if ($content instanceof InputInterface) {
      $this->append(new InputColumn($content, $small, $medium, $large, $xlarge, $xxlarge));
    } else {
      parent::appendColumn($content, $small, $medium, $large, $xlarge, $xxlarge);
    }
    return $this;
  }

}
