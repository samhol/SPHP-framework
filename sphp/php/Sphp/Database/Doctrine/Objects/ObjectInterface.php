<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Doctrine\Objects;

use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Interface describes common features for all Objects.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ObjectInterface extends Arrayable {

  /**
   * Resets all the member values from a given raw data source
   *
   * @param  mixed[] $data raw source data
   * @return $this for a fluent interface
   */
  public function fromArray(array $data = []);

  /**
   * Determines whether the specified object is equal to the current object
   *
   * @param  mixed $object the object to compare with the current object
   * @return boolean true if the specified object is equal to the current
   *         object; otherwise false
   */
  public function equals($object);
}
