<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Traversable;
use Countable;

/**
 * Defines the properties required from a traversable HTML component container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface TraversableContent extends Traversable, Countable, Content {

  /**
   * Returns a collection of sub components that match the search
   *
   * @param  callable $rules a lambda function for testing the sub components
   * @return TraversableContent containing matching sub components
   */
  public function getComponentsBy(callable $rules): TraversableContent;

  /**
   * Returns a collection of sub components that are of the given PHP type
   *
   * @param  string|\object $typeName the name of the searched PHP object type
   * @return TraversableContent containing matching sub components
   */
  public function getComponentsByObjectType($typeName): TraversableContent;
}
