<?php

/**
 * LayoutAdapterTrait.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
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
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
