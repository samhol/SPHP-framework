<?php

/*
 * Arrayable.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Datastructures;

/**
 * Defines properties of aa arrayable data structure
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Arrayable {

  /**
   * Serializes to an array
   *
   * @return array the instance as an array
   */
  public function toArray();
}
