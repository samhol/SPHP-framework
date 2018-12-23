<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Attributes\ClassAttribute;

/**
 * Implements an abstract layout manager for responsive HTML components
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @link    http://foundation.zurb.com/grid.html Foundation grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
trait LayoutAdapterTrait {

  /**
   * Returns the class attribute object
   * 
   * @return ClassAttribute the class attribute object
   */
  abstract public function cssClasses(): ClassAttribute;

  /**
   * 
   * @param  array $group
   * @param  string $value
   * @return $this for a fluent interface
   */
  protected function setOneOf(array $group, string $value = null) {
    if ($value === null) {
      $this->cssClasses()->remove($group);
    } else if (in_array($value, $group)) {
      $this->cssClasses()->remove($group)->add($value);
    }
    return $this;
  }

  /**
   * 
   * @param bool $set
   * @param string $classes
   * @return $this
   */
  protected function setBoolean(bool $set = true, string...$classes) {
    if ($set) {
      $this->cssClasses()->add($classes);
    } else {
      $this->cssClasses()->remove($classes);
    }
    return $this;
  }

}
