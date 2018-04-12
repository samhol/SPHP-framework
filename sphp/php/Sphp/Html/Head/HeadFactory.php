<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

/**
 * Implements an HTML &lt;head&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class HeadFactory {
  
  public static function fromArray(array $meta): Head {
    $group = new Head();
    foreach ($meta as $tag) {
      $group->set(new MetaTag($tag));
    }
    return $group;
  }
}
