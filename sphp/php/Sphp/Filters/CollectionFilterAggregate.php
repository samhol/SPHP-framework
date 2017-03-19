<?php

/**
 * CollectionFilterAggregate.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Filters;

use Traversable;

/**
 * An aggregate of filters
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CollectionFilterAggregate extends FilterAggregate {

  /**
   * Executes the filter for the given value
   * 
   * @param  mixed $value the value to filter
   * @return mixed the filtered value
   */
  public function filter($value) {
    if (is_array($value) || ($value instanceof Traversable)) {
      foreach ($value as $key => $item) {
        $value[$key] = parent::filter($item);
      }
    }
    return $value;
  }

}
