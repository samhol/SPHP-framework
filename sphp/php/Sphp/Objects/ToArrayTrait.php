<?php

/**
 * DefaultEqualsTrait.php (UTF-8)
 * Copyright (c) 2008 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Objects;

use Sphp\Objects\ArrayableObjectInterface as ArrayableObjectInterface;
use Sphp\Objects\ScalarObjectInterface as ScalarObjectInterface;

/**
 * DefaultEqualsTrait implements the default equals method
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-19
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ToArrayTrait {

  public function toArray() {
    $raw = get_object_vars($this);
    $result = [];
    foreach ($raw as $prop => $val) {
      if ($val instanceof DbObjectInterface) {
        $result[$prop] = $val->toArray();
      }
      if ($val instanceof ArrayableObjectInterface) {
        $result = array_merge($result, $val->toArray());
      } else if ($val instanceof ScalarObjectInterface) {
        $result[$prop] = $val->toScalar();
      } else {
        $result[$prop] = $val;
      }
    }
    return $result;
  }

}
