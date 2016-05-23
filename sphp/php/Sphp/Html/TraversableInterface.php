<?php

/**
 * TraversableComponentInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use IteratorAggregate;
use Countable;

/**
 * Interface defines the properties required from a traversable HTML component container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-19
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TraversableInterface extends IteratorAggregate, Countable {

  /**
   * Returns a {@link ContainerInterface} containing sub components
   *  that match the search
   *
   * @param  \Closure $rules a lambda function for testing the sub components
   * @return ContainerInterface containing matching sub components
   */
  public function getComponentsBy(\Closure $rules);

  /**
   * Returns a {@link ContainerInterface} containing sub components that
   *  contain the searched attribute
   *
   * @param  string $attrName the name of the searched attribute
   * @return ContainerInterface containing matching sub components
   */
  public function getComponentsByAttrName($attrName);

  /**
   * Returns a {@link ContainerInterface} containing sub components
   *  that are of the given PHP type
   *
   * @param  string|\object $typeName the name of the searched PHP object type
   * @return ContainerInterface containing matching sub components
   */
  public function getComponentsByObjectType($typeName);
}
