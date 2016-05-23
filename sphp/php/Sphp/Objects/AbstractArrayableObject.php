<?php

/**
 * AbstractObject.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Objects;

/**
 * Class implements some parts of Item interface.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractArrayableObject implements ArrayableObjectInterface {

  use EqualsTrait;

  /**
   * Constructs a new instance
   *
   * @param  null|mixed[] $data the initial raw data from which to parse the object
   */
  public function __construct(array $data = []) {
    $this->fromArray($data);
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    $output = static::class . ":\n";
    foreach ($this->toArray() as $prop => $val) {
      if (is_array($val)) {
        $val = \Sphp\Util\Arrays::implodeWithKeys($val, "\n\t\t", ": ");
      }
      $output .= "\t$prop: $val\n";
    }
    return $output;
  }

}
