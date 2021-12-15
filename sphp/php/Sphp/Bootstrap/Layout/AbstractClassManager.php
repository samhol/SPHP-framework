<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Layout;

use Sphp\Html\Attributes\ClassAttribute;

/**
 * Class AbstractClassManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractClassManager {

  /**
   * @var ClassAttribute
   */
  private ClassAttribute $classes;

  /**
   * Constructor
   * 
   * @param string $attr
   */
  public function __construct(ClassAttribute $attr) {
    $this->classes = $attr;
  }

  public function __destruct() {
    unset($this->classes);
  }

  public function __clone() {
    $this->classes = clone $this->classes;
  }

  public function classAttribute(): ClassAttribute {
    return $this->classes;
  }

}
