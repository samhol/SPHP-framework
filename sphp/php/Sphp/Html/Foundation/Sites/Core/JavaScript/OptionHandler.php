<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core\JavaScript;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Foundation\Sites\Core\DataOptions\DataOptionTools;
use Sphp\Html\Attributes\PropertyCollectionAttribute;

/**
 * Implementation of JavaScriptOptionHandler
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface OptionHandler {

  /**
   * Sets a menu option used in a Foundation menu
   * 
   * @param  string $name the name of the option
   * @param  scalar $value the value of the option
   * @return $this for a fluent interface
   */
  public function setOption(string $name, $value);

  /**
   * Sets a menu option used in a Foundation menu
   * 
   * @param  string $name the name of the option
   * @return scalar the value of the option
   */
  public function getOption(string $name);
}
