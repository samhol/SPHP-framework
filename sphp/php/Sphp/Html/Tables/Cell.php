<?php

/**
 * Cell.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\ContainerTag;

/**
 * Class models HTML table tag's cells
 *
 * {@inheritdoc}
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2012-08-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Cell extends ContainerTag implements CellInterface {

  public function setColspan($value) {
    if ($value == 1) {
      return $this->removeAttr('colspan');
    } else {
      return $this->setAttr('colspan', $value);
    }
  }

  public function getColspan() {
    return intval($this->getAttr('colspan'));
  }

  public function setRowspan($value) {
    if ($value == 1) {
      return $this->removeAttr('rowspan');
    } else {
      return $this->setAttr('rowspan', $value);
    }
  }

  public function getRowspan() {
    return intval($this->getAttr("rowspan"));
  }

}
