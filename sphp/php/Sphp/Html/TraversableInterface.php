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
 * @since   2014-04-19
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TraversableInterface extends Traversable, Countable {

  /**
   * Returns a collection of sub components that match the search
   *
   * @param  callable $rules a lambda function for testing the sub components
   * @return TraversableInterface containing matching sub components
   */
  public function getComponentsBy(callable $rules);

  /**
   * Returns a collection of sub components that contain the searched attribute
   *
   * @param  string $attrName the name of the searched attribute
   * @return TraversableInterface containing matching sub components
   */
  public function getComponentsByAttrName($attrName);

  /**
   * Returns a collection of sub components that are of the given PHP type
   *
   * @param  string|\object $typeName the name of the searched PHP object type
   * @return TraversableInterface containing matching sub components
   */
  public function getComponentsByObjectType($typeName);
}
