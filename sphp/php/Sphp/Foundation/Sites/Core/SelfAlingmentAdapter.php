<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Core;

use Sphp\Stdlib\Arrays;

/**
 * Implements an alignment manger for Flexbox components
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @link    https://foundation.zurb.com/grid.html Foundation grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SelfAlingmentAdapter extends AbstractLayoutManager {

  use SelfAlingmentTrait;

  /**
   * 
   * @param  string|null $alignment
   * @return $this for a fluent interface
   */
  public function setSelfAlignment(string $alignment = null) {
    $this->setOneOf(self::$self, $alignment);
    return $this;
  }

  /**
   * 
   * @param  string|string[] $layouts
   * @return $this for a fluent interface
   */
  public function setLayouts(...$layouts) {
    $flatten = Arrays::flatten($layouts);
    foreach ($flatten as $value) {
      if (in_array($value, self::$self)) {
        $this->setSelfAlignment($value);
      }
    }
    return $this;
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  public function unsetLayouts() {
    $this->setSelfAlignment();
    return $this;
  }

}
