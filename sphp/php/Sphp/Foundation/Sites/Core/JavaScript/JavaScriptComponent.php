<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Core\JavaScript;

/**
 * Defines a Foundation JavaScript component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/javascript.html#configuring-plugins Foundation Plugins
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface JavaScriptComponent {

  /**
   * Sets a menu option used in a Foundation menu
   * 
   * @param  string $name the name of the option
   * @param  scalar $value the value of the option
   * @return $this for a fluent interface
   */
  public function setOption(string $name, $value);
}
