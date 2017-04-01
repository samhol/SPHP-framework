<?php

/**
 * PriorityList.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Datastructures;

/**
 * Description of PriorityList
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-04-01
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PriorityList implements \IteratorAggregate {

  private $items = [];

  public function insert($value, $priority = 0) {
    $this->items[$priority][] = $value;
    krsort($this->items);
    return $this;
  }

  function flatten($array, $prefix = '') {
    $result = array();
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $result = $result + flatten($value, $prefix . $key . '.');
      } else {
        $result[$prefix . $key] = $value;
      }
    }
    return $result;
  }

  public function getIterator() {
    
  }

}
