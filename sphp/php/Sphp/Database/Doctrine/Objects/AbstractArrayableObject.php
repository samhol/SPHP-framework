<?php

/**
 * AbstractObject.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\Doctrine\Objects;

use Sphp\Stdlib\Arrays;

/**
 * Implements some parts of Item interface.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractArrayableObject implements DbObjectInterface {

  /**
   * Constructs a new instance
   *
   * @param array $data the initial raw data from which to parse the object
   */
  public function __construct(array $data = []) {
    $this->fromArray($data);
  }

  public function __toString(): string {
    $output = static::class . ":\n";
    foreach ($this->toArray() as $prop => $val) {
      if (is_array($val)) {
        $val = Arrays::implodeWithKeys($val, "\n\t\t", ": ");
      }
      $output .= "\t$prop: $val\n";
    }
    return $output;
  }

}
