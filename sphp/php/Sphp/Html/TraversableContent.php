<?php

/**
 * TraversableInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Traversable;
use Countable;

/**
 * Defines the properties required from a traversable HTML component container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TraversableContent extends Traversable, Countable, Content {

  /**
   * Returns a collection of sub components that match the search
   *
   * @param  callable $rules a lambda function for testing the sub components
   * @return Container containing matching sub components
   */
  public function getComponentsBy(callable $rules): Container;

  /**
   * Returns a collection of sub components that are of the given PHP type
   *
   * @param  string|\object $typeName the name of the searched PHP object type
   * @return Container containing matching sub components
   */
  public function getComponentsByObjectType($typeName): Container;
}
