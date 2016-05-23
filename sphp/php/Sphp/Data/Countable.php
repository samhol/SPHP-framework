<?php

/*
 * Countable.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

/**
 * An implementation of a multivalue HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Countable extends \Countable {

  /**
   * Determine if the collection is empty or not
   *
   * @return boolean true if the collection is empty, false otherwise
   */
  public function isEmpty();
}
