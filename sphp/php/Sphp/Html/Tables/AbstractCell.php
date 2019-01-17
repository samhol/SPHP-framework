<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Html\ContainerTag;

/**
 * Implements HTML table tag's cells
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractCell extends ContainerTag implements ContainerCell {

  public function setColspan(int $value = null) {
    if ($value <= 1) {
      $this->attributes()->remove('colspan');
    } else {
      $this->attributes()->setAttribute('colspan', $value);
    }
    return $this;
  }

  public function getColspan(): int {
    $span = (int) $this->getAttribute('colspan');
    if ($span < 1) {
      $span = 1;
    }
    return $span;
  }

  public function setRowspan(int $value = null) {
    if ($value <= 1) {
      $this->attributes()->remove('rowspan');
    } else {
      $this->attributes()->setAttribute('rowspan', $value);
    }
    return $this;
  }

  public function getRowspan(): int {
    $span = (int) $this->getAttribute('rowspan');
    if ($span <= 1) {
      $span = 1;
    }
    return $span;
  }

}
