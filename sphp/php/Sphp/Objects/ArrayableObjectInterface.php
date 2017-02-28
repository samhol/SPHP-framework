<?php

/**
 * ArrayableObjectInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Objects;

use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Interface describes common features for all Objects.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ArrayableObjectInterface extends ObjectInterface, Arrayable {

  /**
   * Resets all the member values from a given raw data source
   *
   * @param  mixed[] $data raw source data
   * @return self for a fluent interface
   */
  public function fromArray(array $data = []);

  /**
   * Resets all the member values from a given raw data source
   *
   * @return mixed[] object data suitable for database insertion 
   */
  public function toArray();
}
