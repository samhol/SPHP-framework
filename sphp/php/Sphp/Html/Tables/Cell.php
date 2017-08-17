<?php

/**
 * Cell.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\ContainerTag;

/**
 * Implements HTML table tag's cells
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2012-08-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Cell extends ContainerTag implements CellInterface {

  public function setColspan(int $value) {
    if ($value === 1) {
      $this->attrs()->remove('colspan');
    } else {
      $this->attrs()->set('colspan', $value);
    }
    return $this;
  }

  public function getColspan(): int {
    return (int) $this->getAttr('colspan');
  }

  public function setRowspan(int $value) {
    if ($value == 1) {
      $this->attrs()->remove('rowspan');
    } else {
      $this->attrs()->set('rowspan', $value);
    }
    return $this;
  }

  public function getRowspan(): int {
    return (int) $this->attrs()->get('rowspan');
  }

}
