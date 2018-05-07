<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Doctrine\Objects;

use Sphp\Stdlib\Arrays;

/**
 * Implements some parts of Item interface.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractArrayableObject implements DbObjectInterface {

  /**
   * Constructor
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
