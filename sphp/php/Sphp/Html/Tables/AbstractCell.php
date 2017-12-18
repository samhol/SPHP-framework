<?php

/**
 * AbstractCell.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\ContainerTag;

/**
 * Implements HTML table tag's cells
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractCell extends ContainerTag implements ContainerCell {

  public function setColspan(int $value = null) {
    if ($value <= 1) {
      $this->attrs()->remove('colspan');
    } else {
      $this->attrs()->set('colspan', $value);
    }
    return $this;
  }

  public function getColspan(): int {
    $span = (int) $this->getAttr('colspan');
    if ($span < 1) {
      $span = 1;
    }
    return $span;
  }

  public function setRowspan(int $value = null) {
    if ($value <= 1) {
      $this->attrs()->remove('rowspan');
    } else {
      $this->attrs()->set('rowspan', $value);
    }
    return $this;
  }

  public function getRowspan(): int {
    $span = (int) $this->getAttr('rowspan');
    if ($span <= 1) {
      $span = 1;
    }
    return $span;
  }

}
